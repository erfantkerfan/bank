<?php

namespace App\Http\Controllers;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function username()
    {
        return 'username';
    }

    public function index()
    {
        $user = Auth::user();
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
        $loans = Auth::user()->Loan()->OrderByDesc('date_time')->paginate(12);
        Controller::NumberFormat($loans);
        $summary = Auth::user()->summary();
        $user = Auth::User();
        $requests = Auth::User()->request()->get();
        Controller::NumberFormat($requests);
        $permission = 0;
        return view('Home')->with(['payments'=> $payments ,'loans'=>$loans,'summary'=>$summary,'user'=>$user,
            'permission'=>$permission,'requests'=>$requests]);
    }
}
