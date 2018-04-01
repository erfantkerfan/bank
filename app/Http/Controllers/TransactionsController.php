<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Transaction;
use App\User;
use Hekmatinasser\Verta\Facades\Verta;


class TransactionsController extends Controller
{
    public function username()
    {
        return 'username';
    }

    public function index()
    {
        $payments = Auth::user()->Payment()->get()->SortByDesc('date_time');
        $loans = Auth::user()->Loan()->get()->SortByDesc('date_time');
        $summary = Auth::user()->summary();
        return view('Transactions',compact(['payments','loans','summary']));
    }

    public function create(request $request)
    {
        $proved_by= null;
        if($request->is_proved==1){
            $proved_by = Auth::user()->name;
        };

        $user_id= basename(url()->previous());

        if(($user_id)=='home'){
            $user_id = Auth::user()->id;
        };

        if (Auth::user()->is_super_admin==0 && Auth::user()->id!=$user_id){
            abort(500);
        };

        $this->Validate($request,[
            'payment' => 'required|integer',
            'loan' => 'nullable|integer',
            'loan_payment'=> 'nullable|integer',
            'description' => 'nullable|string',
            'date_time' => 'required',
            'is_proved' => 'nullable',
        ]);

        Transaction::create([
            'user_id' => $user_id,
            'payment' => $request['payment'],
            'loan' => $request['loan'],
            'loan_payment'=> $request['loan_payment'],
            'description' => $request['description'],
            'date_time' => $request['date_time'],
            'is_proved' => $request['is_proved'],
            'proved_by' => $proved_by,
        ]);

        return back();

    }

    public function delete($id)
    {
        Transaction::delete($id);
        return redirect()->back();
    }

    public function edit($id)
    {
        $payment = Transaction::FindOrFail($id)->get()->first();
        return view('transaction_edit',compact('payment'));
    }

    public function restore($id , request $request)
    {
//        if (Auth::user()->is_super_admin==0 && Auth::user()->id!=basename(url()->previous()){
//            abort(500);
//        };

        $this->Validate($request,[
        'payment' => 'required|integer',
        'loan' => 'nullable|integer',
        'loan_payment'=> 'nullable|integer',
        'description' => 'nullable|string',
        'date_time' => 'required',
        'is_proved' => 'nullable',
        ]);

        $data = Transaction::FindOrFail($id);

        $data->payment = $request['payment'];
        $data->loan = $request['loan'];
        $data->loan_payment = $request['loan_payment'];
        $data->description = $request['description'];
        $data->date_time = $request['date_time'];
        $data->is_proved = $request['is_proved'];
        if(Auth::user()->is_super_admin==1 && $request->is_proved==1){
            $data->proved_by = Auth::user()->name;
            };
        if(Auth::user()->is_super_admin==1 && $request->is_proved==0){
            $data->proved_by = null;
        };
        $data->save();

        return redirect(route('user',['id'=>$data->user_id]));
    }
}
