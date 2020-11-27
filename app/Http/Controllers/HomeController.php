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
        $user = auth()->user();
        $payments = $user->Payment()->OrderByDesc('date_time')->get();
        $tote = $user->summary()->payments;
        $sum = 0 ;
        foreach ($payments as $payment){
            $payment -> sum = $payment->payment_cost+$payment->loan_payment_force+$payment->loan_payment+$payment->payment;
            $momentary[$payment->id] = ($payment->is_proved ? $tote - $sum : $tote) ;
            $sum = ($payment->is_proved ? $payment->payment : 0) + $sum;
        }
        $payments = $user->Payment()->OrderByDesc('date_time')->paginate(12, ['*'], 'payments');
        foreach ($payments as $payment){
            $payment -> sum = $payment->payment_cost+$payment->loan_payment_force+$payment->loan_payment+$payment->payment;
            $payment -> momentary = $momentary[$payment->id] ;
        }
        Controller::NumberFormat($payments);
        $loans = auth()->user()->Loan()->OrderByDesc('date_time')->paginate(12, ['*'], 'loans');
        Controller::NumberFormat($loans);
        $loans_archive = auth()->user()->Loan()->onlyTrashed()->OrderByDesc('date_time')->paginate(12, ['*'], 'loans_archive');
        Controller::NumberFormat($loans_archive);
        $summary = auth()->user()->summary();
        $user = auth()->user();
        $requests = auth()->user()->request()->get();
        Controller::NumberFormat($requests);
        $permission = 0;
        return view('home')->with(['payments'=> $payments ,'loans'=>$loans,'summary'=>$summary,'user'=>$user,
            'permission'=>$permission,'requests'=>$requests,'loans_archive'=>$loans_archive]);
    }
}
