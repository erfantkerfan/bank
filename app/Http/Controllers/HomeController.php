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
        $summary = $user->summary();
        $payments = $user->Payment()->get();
        $tote = $summary->payments;
        $sum = 0 ;

        foreach ($payments as $payment){
            $payment -> sum = $payment->payment_cost+$payment->loan_payment_force+$payment->loan_payment+$payment->payment;
            $momentary[$payment->id] = $tote - $sum;
            $sum = ($payment->is_proved ? $payment->payment : 0) + $sum;
        }

        $payments = $user->Payment()->paginate(12, ['*'], 'payments');
        foreach ($payments as $payment){
            $payment -> sum = $payment->payment_cost+$payment->loan_payment_force+$payment->loan_payment+$payment->payment;
            $payment -> momentary = $momentary[$payment->id];
        }

        Controller::NumberFormat($payments);

        $loans = $user->Loan()->paginate(12, ['*'], 'loans');
        Controller::NumberFormat($loans);

        $loans_archive = $user->Loan()->onlyTrashed()->paginate(12, ['*'], 'loans_archive');
        Controller::NumberFormat($loans_archive);

        $requests = $user->request()->get();
        Controller::NumberFormat($requests);
        
        $permission = 0;
        
        return view('home', compact('payments', 'loans', 'summary', 'user', 'permission', 'requests', 'loans_archive'));
    }
}
