<?php

namespace App\Http\Controllers;

use App\Payment;
use Carbon\Carbon;
use App\Onlinepayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ZPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function confirm($id)
    {
        $payment = Payment::query()->findOrFail($id);
        $payment->is_proved = 1;
        $payment->proved_by = auth()->user()->l_name;
        $payment->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $payment = Payment::query()->findOrFail($id);
        if (auth()->user()->is_super_admin != 1 && ($payment->user_id != auth()->id() || $payment->isproved != 0)) {
            abort(403);
        }

        $currentTime = Carbon::now();
        $currentTime->modify('-30 minutes');
        if ($payment->updated_at >= $currentTime && auth()->user()->is_super_admin != 1) {
            $alert = 'امکان حذف پرداخت ها به علت بررسی وضعیت تراکنش های آنلاین تا 30 دقیقه بعد از ثبت ممکن نیست.
                '.$currentTime->diffInMinutes($payment->updated_at).'
                دقیقه دیگر اقدام به حذف کنید.
                ';
            Session::flash('alert', (string) $alert);

            return back();
        }

        if (count($payment->onlinepayment)) {
            $onlinepayment = Onlinepayment::query()->findOrFail($payment->onlinepayment->first()->id);
            $onlinepayment->delete();
        }
        $payment->delete();

        return redirect()->back();
    }

    public function create(Request $request)
    {
        $input = $request->all();
        if ($input["payment"] != null) {
            $input["payment"] = str_replace(",", "", $input["payment"]);
        }
        if (isset($input["negative"]) and $input["negative"] == 1) {
            $input["payment"] = -$input["payment"];
        }
        if ($input["loan_payment"] != null) {
            $input["loan_payment"] = str_replace(",", "", $input["loan_payment"]);
        }
        if ($input["loan_payment_force"] != null) {
            $input["loan_payment_force"] = str_replace(",", "", $input["loan_payment_force"]);
        }
        if ($input["payment_cost"] != null) {
            $input["payment_cost"] = str_replace(',', '', $input['payment_cost']);
        }
        $request->replace((array)$input);

        switch ($request->online_payment) {
            #TODO: make separate routes for this switches
            case '0':
                $user_id = strtok(basename(url()->previous()), '?');
                if (($user_id) == 'home') {
                    $user_id = auth()->id();
                }
                if (auth()->user()->is_super_admin == 0 && auth()->id() != $user_id) {
                    abort(500);
                }

                $is_proved = 0;
                if (($request->has('is_proved')) && auth()->user()->is_super_admin == 1) {
                    $is_proved = $request->is_proved;
                }

                $proved_by = null;
                if ($is_proved == 1) {
                    $proved_by = auth()->user()->l_name;
                }

                $creator = auth()->user()->f_name . ' ' . auth()->user()->l_name;

                $date_time = verta();

                $this->Validate($request, [
                    'payment' => 'required|integer',
                    'payment_cost' => 'nullable|integer',
                    'loan_payment' => 'nullable|integer',
                    'loan_payment_force' => 'nullable|integer',
                    'description' => 'nullable|string',
                    'is_proved' => 'nullable|boolean',
                ]);


                Payment::create([
                    'user_id' => $user_id,
                    'date_time' => $date_time,
                    'is_proved' => $is_proved,
                    'proved_by' => $proved_by,
                    'payment' => $request['payment'],
                    'payment_cost' => $request['payment_cost'],
                    'loan_payment' => $request['loan_payment'],
                    'loan_payment_force' => $request['loan_payment_force'],
                    'description' => $request['description'],
                    'creator' => $creator,
                ]);
                return back();

            case '1':
                $proved_by = null;

                $user_id = strtok(basename(url()->previous()), '?');

                if (($user_id) == 'home') {
                    $user_id = auth()->id();
                }

                if (auth()->user()->is_super_admin == 0 && auth()->id() != $user_id) {
                    abort(500);
                };
                $is_proved = 0;

                $creator = auth()->user()->f_name . ' ' . auth()->user()->l_name;

                $date_time = verta();

                $this->Validate($request, [
                    'payment' => 'required|integer',
                    'payment_cost' => 'nullable|integer',
                    'loan_payment' => 'nullable|integer',
                    'loan_payment_force' => 'nullable|integer',
                    'description' => 'nullable|string',
                    'is_proved' => 'nullable|boolean',
                ]);

                $payment_data = Payment::create([
                    'user_id' => $user_id,
                    'date_time' => $date_time,
                    'is_proved' => $is_proved,
                    'proved_by' => $proved_by,
                    'payment' => $request['payment'],
                    'payment_cost' => $request['payment_cost'],
                    'loan_payment' => $request['loan_payment'],
                    'loan_payment_force' => $request['loan_payment_force'],
                    'description' => $request['description'],
                    'note' => 'پرداخت اینترنتی',
                    'creator' => $creator,
                ]);

                $amount = ($request['payment'] + $request['payment_cost'] + $request['loan_payment'] + $request['loan_payment_force']) / 10;

                $invoice = new Invoice;
                $invoice->amount($amount);
                $invoice->detail(['description' => $creator . ' ' . $date_time]);

                $onlinepayment = new Onlinepayment;
                $onlinepayment->payment_id = $payment_data->id;
                $onlinepayment->amount = $amount * 10;
                $bill = ZPayment::callbackUrl(route('verify'))->purchase($invoice, function() {})->pay();

                $onlinepayment->authority = $invoice->getTransactionId();
                $onlinepayment->save();

                return $bill->render();
        }
    }

    public function verify()
    {
        $transaction_id = request()->input('Authority');
        $onlinepayment = Onlinepayment::where('authority', '=', $transaction_id)->firstOrFail();
        try {
            $receipt = ZPayment::amount(($onlinepayment->amount) / 10)->transactionId($onlinepayment->authority)->verify();
        } catch (InvalidPaymentException $exception) {
            return view('errors.payment');
        }
        $onlinepayment->refid = $receipt->getReferenceId();
        $onlinepayment->save();
        $payment = Payment::where('id', '=', $onlinepayment->payment_id)->first();
        $payment->is_proved = 1;
        $payment->proved_by = $receipt->getReferenceId();
        $payment->save();

        return redirect(route('home'));
    }

    public function unverified()
    {
        $response = Http::post(config('payment.drivers.zarinpal.unverifiedApiPurchaseUrl'), [
            'merchant_id' => config('payment.drivers.zarinpal.merchantId'),
        ]);
        $alert = 'تراکنش تایید نشده ای از سمت زرین پال اعلام نشد';
        if(
            $response->successful() &&
            isset(json_decode($response->body())->data) &&
            json_decode($response->body())->data->code == 100 &&
            !empty(json_decode($response->body())->data->authorities)
        ){
            foreach (json_decode($response->body())->data->authorities as $pay) {
                $Authority = str_pad($pay->authority, 36, '0', STR_PAD_LEFT);
                $onlinepayment = Onlinepayment::where('authority', '=', $Authority)->withTrashed()->firstOrFail();
                try {
                    $receipt = ZPayment::amount(($onlinepayment->amount) / 10)->transactionId($onlinepayment->authority)->verify();
                } catch (InvalidPaymentException $exception) {
                    continue;
                }
                $onlinepayment->refid = $receipt->getReferenceId();
                $onlinepayment->deleted_at = null;
                $onlinepayment->save();
                $payment = Payment::where('id', '=', $onlinepayment->payment_id)->first();
                $payment->is_proved = 1;
                $payment->proved_by = $receipt->getReferenceId();
                $payment->save();
            }
            $alert = 'لیست تراکنش ها به رو رسانی شد';
        }

        Session::flash('alert', (string) $alert);
        return back();
    }

    public function show_edit($id)
    {
        $payment = Payment::query()->findOrFail($id);
        return view('payment_edit', compact('payment'));
    }

    public function edit(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $input = $request->all();
        if ($input["payment"] != null) {
            $input["payment"] = str_replace(",", "", $input["payment"]);
        }
        if ($input["loan_payment"] != null) {
            $input["loan_payment"] = str_replace(",", "", $input["loan_payment"]);
        }
        if ($input["loan_payment_force"] != null) {
            $input["loan_payment_force"] = str_replace(",", "", $input["loan_payment_force"]);
        }
        if ($input["payment_cost"] != null) {
            $input["payment_cost"] = str_replace(',', '', $input['payment_cost']);
        }
        $request->replace((array)$input);


        $this->Validate($request, [
            'payment' => 'required|integer',
            'payment_cost' => 'nullable|integer',
            'loan_payment' => 'nullable|integer',
            'loan_payment_force' => 'nullable|integer',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'delay' => 'nullable|integer',
        ]);

        if ($payment->is_proved == 1 && !is_numeric($payment->proved_by)) {
            $payment->proved_by = auth()->user()->f_name . ' ' . auth()->user()->l_name;
        }
        $payment->payment = $request->payment;
        $payment->payment_cost = $request->payment_cost;
        $payment->loan_payment = $request->loan_payment;
        $payment->loan_payment_force = $request->loan_payment_force;
        $payment->description = $request->description;
        $payment->note = $request->note;
        $payment->delay = $request->delay;

        $payment->save();

        return redirect(route('user', ['id' => $payment->user_id]));
    }
}
