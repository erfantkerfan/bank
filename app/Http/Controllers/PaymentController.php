<?php

namespace App\Http\Controllers;
use App\Onlinepayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\payment;
use Zarinpal\Laravel\Facade\Zarinpal;

class PaymentController extends Controller
{
    public function confirm($id)
    {
        $payment = Payment::FindOrFail($id);
        $payment->is_proved = 1;
        $payment->proved_by = Auth::User()->l_name;
        $payment-> save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $payment = Payment::FindOrFail($id);
        if (Auth::user()->is_super_admin == 1 || ($payment->user_id==Auth::user()->id && $payment->isproved==0)) {
            $payment->delete();
            return redirect()->back();
        } else {
            abort(403);
        }
    }

    public function create(request $request)
    {
        $input = $request->all();
        if($input["payment"]!=null){$input["payment"] = str_replace(",","",$input["payment"]);}
        if(isset($input["negative"]) and $input["negative"]==1){$input["payment"] = -$input["payment"];}
        if($input["loan_payment"]!=null){$input["loan_payment"] = str_replace(",","",$input["loan_payment"]);}
        if($input["loan_payment_force"]!=null){$input["loan_payment_force"] = str_replace(",","",$input["loan_payment_force"]);}
        if($input["payment_cost"]!=null){$input["payment_cost"] = str_replace(',','',$input['payment_cost']);}
        $request->replace((array)$input);

        switch($request->online_payment) {

            case '0':
                $proved_by = null;
                if($request->is_proved==1){
                    $proved_by = Auth::User()->l_name;
                };

                $user_id= basename(url()->previous());

                if(($user_id)=='home'){
                    $user_id = Auth::user()->id;
                }

                if (Auth::user()->is_super_admin==0 && Auth::user()->id!=$user_id){
                    abort(500);
                };
                if(($request->has('is_proved'))){
                    $is_proved = $request->is_proved;
                }
                else{
                    $is_proved=0;
                }

                $creator = Auth::User()->f_name.' '.Auth::User()->l_name;

                $date_time = verta();

                $this->Validate($request,[
                    'payment' => 'required|integer',
                    'payment_cost' => 'nullable|integer',
                    'loan_payment'=> 'nullable|integer',
                    'loan_payment_force'=> 'nullable|integer',
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
                    'loan_payment'=> $request['loan_payment'],
                    'loan_payment_force'=> $request['loan_payment_force'],
                    'description' => $request['description'],
                    'creator' => $creator,
                ]);
                return back();
                break;

            case '1':
                $proved_by = null;

                $user_id= basename(url()->previous());

                if(($user_id)=='home'){
                    $user_id = Auth::user()->id;
                }

                if (Auth::user()->is_super_admin==0 && Auth::user()->id!=$user_id){
                    abort(500);
                };
                $is_proved=0;

                $creator = Auth::User()->f_name.' '.Auth::User()->l_name;

                $date_time = verta();

                $this->Validate($request,[
                    'payment' => 'required|integer',
                    'payment_cost' => 'nullable|integer',
                    'loan_payment'=> 'nullable|integer',
                    'loan_payment_force'=> 'nullable|integer',
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
                    'loan_payment'=> $request['loan_payment'],
                    'loan_payment_force'=> $request['loan_payment_force'],
                    'description' => $request['description'],
                    'note' => 'زرین پال',
                    'creator' => $creator,
                ]);

                $amount = ($request['payment']+$request['payment_cost']+$request['loan_payment']+$request['loan_payment_force'])/10;
                $results = Zarinpal::request(
                    route('verify'),
                    $amount,
                    $creator.' '.$date_time
                );

                if ($results['Authority']!=null){
                    Onlinepayment::create([
                        'payment_id' => $payment_data->id,
                        'amount' => $amount*10,
                        'authority' => $results['Authority']
                    ]);
                    Zarinpal::redirect();
                }else{
                    return view('errors.payment');
                }
                break;
        }
    }

    public function verify()
    {
        if ($_GET['Status'] == 'OK') {
            $Authority = $_GET['Authority'];
            $onlinepayment = Onlinepayment::where('authority','=',$Authority)->firstOrFail();
            dd($onlinepayment);
            $result = Zarinpal::verify('OK',($onlinepayment->amount)/10,$onlinepayment->authority);
            if ($result->Status == 100) {
                $onlinepayment->refid = $result->RefID;
                $onlinepayment->save();
                $payment = $onlinepayment->payment();
                $payment->is_proved=1;
                $payment->proved_by=$result->RefID;
                $payment->save();
            } else {
                return view('errors.payment');
            }
        } else {
            return view('errors.payment');
        }
    }

    public function show_edit($id)
    {
        $payment = Payment::FindOrFail($id);
        return view('payment_edit')->with(['payment'=>$payment]);
    }
    public function edit(request $request , $id)
    {
        $payment = Payment::FindOrFail($id);

        $input = $request->all();
        if($input["payment"]!=null){$input["payment"] = str_replace(",","",$input["payment"]);}
        if($input["loan_payment"]!=null){$input["loan_payment"] = str_replace(",","",$input["loan_payment"]);}
        if($input["loan_payment_force"]!=null){$input["loan_payment_force"] = str_replace(",","",$input["loan_payment_force"]);}
        if($input["payment_cost"]!=null){$input["payment_cost"] = str_replace(',','',$input['payment_cost']);}
        $request->replace((array)$input);


        $this->Validate($request,[
            'payment' => 'required|integer',
            'payment_cost' => 'nullable|integer',
            'loan_payment'=> 'nullable|integer',
            'loan_payment_force'=> 'nullable|integer',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'delay' => 'nullable|integer',
        ]);

        if ($payment->is_proved==1){
            $payment->proved_by = Auth::User()->f_name.' '.Auth::User()->l_name;
        }
        $payment->payment = $request->payment;
        $payment->payment_cost = $request->payment_cost;
        $payment->loan_payment = $request->loan_payment;
        $payment->loan_payment_force = $request->loan_payment_force;
        $payment->description = $request->description;
        $payment->note = $request->note;
        $payment->delay = $request->delay;

        $payment->save();

        return redirect(route('user',['id'=>$payment->user_id]));
    }
}
