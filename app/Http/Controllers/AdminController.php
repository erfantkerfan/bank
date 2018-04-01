<?php

namespace App\Http\Controllers;

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
        return view('admin_panel', compact(['users', 'all_payment_summary', 'all_loan_summary']));
    }

    public function user($id)
    {
        $user = User::FindOrFail($id);
        $payments = $user->Payment()->get()->SortByDesc('date_time');
        $loans = $user->Loan()->get()->SortByDesc('date_time');
        $summary = User::FindOrFail($id)->summary();
        return view('admin_user', compact(['user', 'payments', 'summary', 'loans']));
    }

    public function not_proved()
    {
        $np_payments = Payment::where('is_proved', '=', '0')->with('user')->get();
        $np_loans = Loan::where('is_proved', '=', '0')->with('user')->get();
        return view('unproved', compact(['np_payments', 'np_loans']));
    }

    public function notes()
    {
        $users = User::where('note', '!=', null)->get();
        return view('notes', compact('users'));
    }
}
