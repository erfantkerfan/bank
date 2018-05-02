<?php

namespace App\Http\Controllers;
use App\Expense;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Payment;
use App\Loan;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy('acc_id')->paginate(300);
        $all_payment_summary = Payment::all_payment_summary();
        $all_loan_summary = Loan::all_loan_summary();
        return view('admin_panel')->with(['users'=>$users, 'all_payment_summary'=>$all_payment_summary, 'all_loan_summary'=>$all_loan_summary]);
    }

    public function user($id)
    {
        $user = User::FindOrFail($id);
        $payments = $user->Payment()->OrderByDesc('date_time')->paginate(12);
        $loans = $user->Loan()->OrderByDesc('date_time')->paginate(12);
        $summary = User::FindOrFail($id)->summary();
        $permission = 1;
        return view('Home')->with(['user'=>$user, 'payments'=>$payments, 'summary'=>$summary, 'loans'=>$loans,'permission'=>$permission]);
    }

    public function unproved()
    {
        $payments = Payment::where('is_proved', '=', '0')->with('user')->get();
        $loans = Loan::where('is_proved', '=', '0')->with('user')->get();
        return view('unproved')->with(['payments'=>$payments, 'loans'=>$loans]);
    }
}
