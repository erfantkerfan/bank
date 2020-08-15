<?php

namespace App\Http\Controllers;

use App\Onlinepayment;
use App\payment;
use Carbon\Carbon;
use ffb343\PHPZarinpal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Zarinpal\Laravel\Facade\Zarinpal;

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
        if (Auth::user()->is_super_admin == 1 || ($payment->user_id == Auth::user()->id && $payment->isproved == 0)) {
            $currentTime = Carbon::now();
            $currentTime->modify('-30 minutes');
            if ($payment->updated_at >= $currentTime) {
                $alert = 'امکان حذف پرداخت ها به علت بررسی وضعیت تراکنش های آنلاین تا 30 دقیقه بعد از ثبت ممکن نیست.
                ' .
                    $currentTime->diffInMinutes($payment->updated_at)
                    . '
                دقیقه دیگر اقدام به حذف کنید.
                ';
                Session::flash('alert', (string)$alert);
                return back();
            }
            if (count($payment->onlinepayment)) {
                $onlinepayment = Onlinepayment::query()->findOrFail($payment->onlinepayment->first()->id);
                $onlinepayment->delete();
            }
            $payment->delete();
            return redirect()->back();
        } else {
            abort(403);
        }
    }

    public function create(request $request)
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

            case '0':
                $user_id = basename(url()->previous());
                if (($user_id) == 'home') {
                    $user_id = Auth::user()->id;
                }
                if (Auth::user()->is_super_admin == 0 && Auth::user()->id != $user_id) {
                    abort(500);
                };
                $is_proved = 0;
                if (($request->has('is_proved')) && auth()->user()->is_super_admin == 1) {
                    $is_proved = $request->is_proved;
                }
                $proved_by = null;
                if ($is_proved == 1) {
                    $proved_by = auth()->user()->l_name;
                };


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
                break;

            case '1':
                $proved_by = null;

                $user_id = basename(url()->previous());

                if (($user_id) == 'home') {
                    $user_id = Auth::user()->id;
                }

                if (Auth::user()->is_super_admin == 0 && Auth::user()->id != $user_id) {
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
                $results = Zarinpal::request(
                    route('verify'),
                    $amount,
                    $creator . ' ' . $date_time
                );

                if ($results['Authority'] != null) {
                    Onlinepayment::create([
                        'payment_id' => $payment_data->id,
                        'amount' => $amount * 10,
                        'authority' => $results['Authority']
                    ]);
                    Zarinpal::redirect();
                } else {
                    return view('errors.payment');
                }
                break;
        }
    }

    public function verify()
    {
        if ($_GET['Status'] == 'OK') {
            $Authority = $_GET['Authority'];
            $onlinepayment = Onlinepayment::where('authority', '=', $Authority)->firstOrFail();
            $result = Zarinpal::verify('OK', ($onlinepayment->amount) / 10, $onlinepayment->authority);
            $result = (object)$result;
            if ($result->Status == 'success' || $result->Status == 'verified_before') {
                $onlinepayment->refid = $result->RefID;
                $onlinepayment->save();
                $payment = Payment::where('id', '=', $onlinepayment->payment_id)->first();
                $payment->is_proved = 1;
                $payment->proved_by = $result->RefID;
                $payment->save();
                return redirect(route('home'));
            } else {
                return view('errors.payment');
            }
        } else {
            return view('errors.payment');
        }
    }

    public function unverified()
    {
        $merchantID = config('services.zarinpal.merchantID', config('Zarinpal.merchantID'));
        $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
        $ans = $client->GetUnverifiedTransactions(['MerchantID' => $merchantID]);

        if (!($ans->Status == 100 && json_decode($ans->Authorities) != null)) {
            return back();
        }

        foreach (json_decode($ans->Authorities) as $pay) {
            $Authority = str_pad($pay->Authority, 36, '0', STR_PAD_LEFT);
            $onlinepayment = Onlinepayment::where('authority', '=', $Authority)->withTrashed()->firstOrFail();
            $result = Zarinpal::verify('OK', ($onlinepayment->amount) / 10, $onlinepayment->authority);
            $result = (object)$result;
            if (!($result->Status == 'success' || $result->Status == 'verified_before')) {
                continue;
            }
            $onlinepayment->refid = $result->RefID;
            $onlinepayment->deleted_at = null;
            $onlinepayment->save();
            $payment = Payment::where('id', '=', $onlinepayment->payment_id)->first();
            $payment->is_proved = 1;
            $payment->proved_by = $result->RefID;
            $payment->save();

        }


        return back();
    }

    public function show_edit($id)
    {
        $payment = Payment::query()->findOrFail($id);
        return view('payment_edit')->with(['payment' => $payment]);
    }

    public function edit(request $request, $id)
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
