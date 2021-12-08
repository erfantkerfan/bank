<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Payment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('user')->OrderByDesc('date_time')->paginate(20);
        Controller::NumberFormat($expenses);
        $expense = Expense::all()->sum('expense');
        $payments_cost = Payment::where('is_proved','=','1')->sum('payment_cost');
        $users = User::with('payment')->get();
        foreach ($users as $user)
        {
            $user->addTotalPayment();
        }

        return view('expense', compact('expenses', 'expense', 'payments_cost', 'users'));
    }

    public function create(Request $request)
    {
        $input = $request->all();
        if($input["expense"]!=null){$input["expense"] = str_replace(",","",$input["expense"]);}
        $request->replace((array)$input);

        $user_id = auth()->user()->id;

        $date_time = verta();

        $this->Validate($request, [
            'expense' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        Expense::create([
            'user_id' => $user_id,
            'date_time' => $date_time,
            'expense' => $request['expense'],
            'description' => $request['description'],
        ]);

        return back();
    }

    public function delete($id)
    {
        $expense = Expense::query()->findOrFail($id);
        $expense -> delete();
        return redirect()->back();
    }
}
