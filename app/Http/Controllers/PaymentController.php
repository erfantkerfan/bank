<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\payment;

class PaymentController extends Controller
{
    public function confirm($id)
    {
        $payment = Payment::FindOrFail($id);
        $payment->is_proved = 1;
        $payment->proved_by = Auth::User()->f_name.' '.Auth::User()->l_name;
        $payment-> save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $payment = Payment::FindOrFail($id);
        $payment -> delete();
        return redirect()->back();
    }

    public function create(request $request)
    {
        $input = $request->all();
        if($input["payment"]!=null){$input["payment"] = str_replace(",","",$input["payment"]);}
        if($input["loan_payment"]!=null){$input["loan_payment"] = str_replace(",","",$input["loan_payment"]);}
        if($input["loan_payment_force"]!=null){$input["loan_payment_force"] = str_replace(",","",$input["loan_payment_force"]);}
        if($input["payment_cost"]!=null){$input["payment_cost"] = str_replace(',','',$input['payment_cost']);}
        $request->replace((array)$input);

        switch($request->online_payment) {

            case '0':
                $proved_by = null;
                if($request->is_proved==1){
                    $proved_by =Auth::User()->f_name.' '.Auth::User()->l_name;
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

                $date_time = verta()->formatdate();

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
                ]);
                break;

            case '1':
                //ToDO adding online payment
                break;
        }
        return back();
    }
}
