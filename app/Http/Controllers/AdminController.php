<?php

namespace App\Http\Controllers;
use App\Expense;
use App\Onlinepayment;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Payment;
use App\Loan;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy('acc_id')->get();
        $all_payment_summary = Payment::all_payment_summary();
        $all_loan_summary = Loan::all_loan_summary();
        return view('admin_panel')->with(['users'=>$users, 'all_payment_summary'=>$all_payment_summary, 'all_loan_summary'=>$all_loan_summary]);
    }

    public function user($id)
    {
        $user = User::FindOrFail($id);
        $payments = $user->Payment()->OrderByDesc('date_time')->paginate(12);
        foreach ($payments as $payment){
            $payment -> sum = $payment->payment_cost+$payment->loan_payment_force+$payment->loan_payment+$payment->payment;
        }
        Controller::NumberFormat($payments);
        $loans = $user->Loan()->OrderByDesc('date_time')->paginate(12);
        Controller::NumberFormat($loans);
        $summary = User::FindOrFail($id)->summary();
        $requests = $user->request()->get();
        Controller::NumberFormat($requests);
        $permission = 1;
        return view('Home')->with(['user'=>$user, 'payments'=>$payments, 'summary'=>$summary, 'loans'=>$loans,
            'permission'=>$permission,'requests'=>$requests]);
    }

    public function unproved1()
    {
        $payments = Payment::where('is_proved', '=', '0')->with('user')->get();
        Controller::NumberFormat($payments);
        return view('unproved1')->with(['payments'=>$payments]);
    }
    public function unproved2()
    {
        $loans = Loan::where('is_proved', '=', '0')->with('user')->get();
        Controller::NumberFormat($loans);
        return view('unproved2')->with(['loans'=>$loans]);
    }
    public function unproved3()
    {
        $onlines = Onlinepayment::with(['payment'])->get();
        $array = ['loan','payment','loan_payment','loan_payment_force','payment_cost','expense','instalment','instalment_force','sum','fee'];
        foreach ($array as $par){
            foreach ($onlines as $var) {
                if (isset($var->payment->$par)) {
                    $var->payment->$par = number_format($var->payment->$par);
                }
            }
        }
        $onlines = (object)$onlines;
//        Controller::NumberFormat($payments);
        return view('unproved3')->with(['onlines'=>$onlines]);
    }
}
