<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Onlinepayment;
use App\Payment;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy($request->sort ? $request->sort : 'acc_id', $request->sort_order ? $request->sort_order : 'asc')->get();
        $all_payment_summary = Payment::all_payment_summary();
        $all_loan_summary = Loan::all_loan_summary();
        return view('admin_panel', compact('users', 'all_payment_summary', 'all_loan_summary'));
    }

    public function transaction(Request $request)
    {
        $users = User::with(['Payment', 'Loan'])->orderBy('acc_id')->paginate(20);
        foreach ($users as $user) {
            /**@var User $user*/
            $user->summary = $user->summary();
            $user->summary->delays = $user->delays();
            $user->summary->debt_all = $user->summary->debt + $user->summary->debt_force;
        }
        if ($request->has('sort')) {
            $users = $users->sortByDesc('summary.' . $request->sort);
        }
        return view('admin_transaction', compact('users'));
    }

    public function user($id)
    {
        $user = User::query()->findOrFail($id);
        $next_user_acc_id = User::where('acc_id', '>', $user->acc_id)->min('acc_id');
        $next_user = null;
        if (!is_null($next_user_acc_id)) {
            $next_user = User::where('acc_id', '=', $next_user_acc_id)->first()->id;
        }
        $previous_user_acc_id = User::where('acc_id', '<', $user->acc_id)->max('acc_id');
        $previous_user = null;
        if (!is_null($previous_user_acc_id)) {
            $previous_user = User::where('acc_id', '=', $previous_user_acc_id)->first()->id;
        }
        $payments = $user->Payment()->OrderByDesc('date_time')->get();
        $tote = $user->summary()->payments;
        $sum = 0;
        $momentary = [];
        foreach ($payments as $payment) {
            $payment->sum = $payment->payment_cost + $payment->loan_payment_force + $payment->loan_payment + $payment->payment;
            $momentary[$payment->id] = ($payment->is_proved ? $tote - $sum : $tote);
            $sum = ($payment->is_proved ? $payment->payment : 0) + $sum;
        }
        $payments = $user->Payment()->OrderByDesc('date_time')->paginate(12, ['*'], 'payments');
        foreach ($payments as $payment) {
            $payment->sum = $payment->payment_cost + $payment->loan_payment_force + $payment->loan_payment + $payment->payment;
            $payment->momentary = $momentary[$payment->id];
        }
        Controller::NumberFormat($payments);
        $loans = $user->Loan()->OrderByDesc('date_time')->paginate(12, ['*'], 'loans');
        Controller::NumberFormat($loans);
        $loans_archive = $user->Loan()->onlyTrashed()->OrderByDesc('date_time')->paginate(12, ['*'], 'loans_archive');
        Controller::NumberFormat($loans_archive);
        $summary = User::query()->findOrFail($id)->summary();
        $requests = $user->request()->get();
        Controller::NumberFormat($requests);
        $permission = 1;
        return view('home', compact('user', 'payments', 'summary', 'loans', 'permission', 'requests',
            'next_user', 'previous_user', 'momentary', 'loans_archive'));
    }

    public function unproved1()
    {
        $payments = Payment::where('is_proved', '=', '0')->with('user')->get();
        Controller::NumberFormat($payments);
        return view('unproved1', compact('payments'));
    }

    public function unproved2()
    {
        $loans = Loan::where('is_proved', '=', '0')->where('force', '0')->with('user')->get();
        $loans_force = Loan::where('is_proved', '=', '0')->where('force', '1')->with('user')->get();
        Controller::NumberFormat($loans);
        Controller::NumberFormat($loans_force);
        return view('unproved2', compact('loans', 'loans_force'));
    }

    public function unproved3()
    {
        $onlines = Onlinepayment::with('payment.user')
            ->whereHas('payment', function ($query) {
                $query->whereNull('delay');
            })->get();
        #TODO: duplicate code: make it compatible with Controller::NumberFormat()
        $array = ['loan', 'payment', 'loan_payment', 'loan_payment_force', 'payment_cost', 'expense', 'instalment', 'instalment_force', 'sum', 'fee'];
        foreach ($array as $par) {
            foreach ($onlines as $var) {
                if (isset($var->payment->$par)) {
                    $var->payment->$par = number_format($var->payment->$par);
                }
            }
        }
        $onlines = (object)$onlines;

        return view('unproved3', compact('onlines'));
    }

    public function database()
    {
        $filename = 'app/public/Mysql_Backup_Ghaem.sql';
        return response()->download(storage_path($filename));
    }
}
