<?php

namespace App\Http\Controllers;
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
        $payments = Auth::user()->Payment()->OrderByDesc('date_time')->paginate(12);
        $loans = Auth::user()->Loan()->OrderByDesc('date_time')->paginate(12);
        $summary = Auth::user()->summary();
        return view('Home')->with(['payments'=> $payments ,'loans'=>$loans,'summary'=>$summary]);
    }
}
