<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function username()
    {
        return 'username';
    }

    public function index()
    {
        #TODO: this part make lots of queries!!! needs refactor
        $permission = 0;
        $user = auth()->user();
        $payments = $user->Payment()->get();
        $summary = $user->summary();
        $tote = $summary->payments;
        // -2 (6 -> 4)
        $sum = 0;

        foreach ($payments as $payment) {
            $payment->sum = $payment->payment_cost + $payment->loan_payment_force + $payment->loan_payment + $payment->payment;
            $momentary[$payment->id] = $tote - $sum;
            $sum = ($payment->is_proved ? $payment->payment : 0) + $sum;
        }

        $payments = $user->Payment()->paginate(12, ['*'], 'payments');
        foreach ($payments as $payment) {
            $payment->sum = $payment->payment_cost + $payment->loan_payment_force + $payment->loan_payment + $payment->payment;
            $payment->momentary = $momentary[$payment->id];
        }

        Controller::NumberFormat($payments);
        $loans = $user->Loan()->paginate(12, ['*'], 'loans');
        Controller::NumberFormat($loans);
        $loans_archive = $user->Loan()->onlyTrashed()->paginate(12, ['*'], 'loans_archive');
        Controller::NumberFormat($loans_archive);
        $requests = $user->request()->get();
        Controller::NumberFormat($requests);
        return view('home', compact('payments', 'loans', 'summary', 'user', 'permission', 'requests', 'loans_archive'));
    }
}
