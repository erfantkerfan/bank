<?php

namespace App\Http\Controllers;
use App\Expense;
use App\Onlinepayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Payment;
use App\Loan;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->sort == 'login'){
            $users = User::orderBy('new_login','desc')->get();
        }else{
            $users = User::orderBy('acc_id')->get();
        }

        $all_payment_summary = Payment::all_payment_summary();
        $all_loan_summary = Loan::all_loan_summary();
        return view('admin_panel')->with(['users'=>$users, 'all_payment_summary'=>$all_payment_summary, 'all_loan_summary'=>$all_loan_summary]);
    }

    public function transaction(Request $request)
    {
        $users = User::orderBy('acc_id')->get();
        foreach ($users as $user){
            $user->summary = $user->summary();
            $user->summary->delays = $user->delays();
            $user->summary->debt_all = $user->summary->debt + $user->summary->debt_force;
        }
        if ($request->has('sort')){
        $users = $users->sortByDesc('summary.'.$request->sort);
        }
        return view('admin_transaction')->with(compact('users'));
    }

    public function user($id)
    {
        $user = User::FindOrFail($id);
        $next_user_acc_id = User::where('acc_id', '>', $user->acc_id)->min('acc_id');
        $next_user = null;
        if(!is_null($next_user_acc_id)){
            $next_user = User::where('acc_id', '=', $next_user_acc_id)->first()->id;
        }
        $previous_user_acc_id = User::where('acc_id', '<', $user->acc_id)->max('acc_id');
        $previous_user = null;
        if(!is_null($previous_user_acc_id)){
            $previous_user = User::where('acc_id', '=', $previous_user_acc_id)->first()->id;
        }
        $payments = $user->Payment()->OrderByDesc('date_time')->get();
        $tote = $user->Payment()->sum('payment');
        $sum = 0 ;
        foreach ($payments as $payment){
            $payment -> sum = $payment->payment_cost+$payment->loan_payment_force+$payment->loan_payment+$payment->payment;
            $momentary[$payment->id] = $tote - $sum ;
            $sum = $payment->payment + $sum;
        }
        $payments = $user->Payment()->OrderByDesc('date_time')->paginate(12);
        foreach ($payments as $payment){
            $payment -> sum = $payment->payment_cost+$payment->loan_payment_force+$payment->loan_payment+$payment->payment;
            $payment -> momentary = $momentary[$payment->id] ;
        }
        Controller::NumberFormat($payments);
        $loans = $user->Loan()->OrderByDesc('date_time')->paginate(12);
        Controller::NumberFormat($loans);
        $loans_archive = $user->Loan()->onlyTrashed()->OrderByDesc('date_time')->paginate(12);
        Controller::NumberFormat($loans_archive);
        $summary = User::FindOrFail($id)->summary();
        $requests = $user->request()->get();
        Controller::NumberFormat($requests);
        $permission = 1;
        return view('Home')->with(compact('user','payments','summary','loans','permission','requests',
            'next_user','previous_user','momentary','loans_archive'));
    }

    public function unproved1()
    {
        $payments = Payment::where('is_proved', '=', '0')->with('user')->get();
        Controller::NumberFormat($payments);
        return view('unproved1')->with(['payments'=>$payments]);
    }
    public function unproved2()
    {
        $loans = Loan::where('is_proved', '=', '0')->where('force','0')->with('user')->get();
        $loans_force = Loan::where('is_proved', '=', '0')->where('force','1')->with('user')->get();
        Controller::NumberFormat($loans);
        Controller::NumberFormat($loans_force);
        return view('unproved2')->with(['loans'=>$loans,'loans_force'=>$loans_force]);
    }
    public function unproved3()
    {
//        $onlines = Onlinepayment::with(['payment3.user'])->where('delay','!=',null)->get();
        $onlines =Onlinepayment::with('payment.user')
            ->whereHas('payment', function($query)
            {
                $query->whereNull('delay');
            })->get();
//        Controller::NumberFormat($payments);
        $array = ['loan','payment','loan_payment','loan_payment_force','payment_cost','expense','instalment','instalment_force','sum','fee'];
        foreach ($array as $par){
            foreach ($onlines as $var) {
                if (isset($var->payment->$par)) {
                    $var->payment->$par = number_format($var->payment->$par);
                }
            }
        }
        $onlines = (object)$onlines;

        return view('unproved3')->with(['onlines'=>$onlines]);
    }
}
