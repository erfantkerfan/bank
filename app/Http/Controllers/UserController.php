<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function edit($id)
    {
        $user=User::FindOrFail($id);
        return view('user_edit')->with(['user' => $user]);
    }

    public function instalments()
    {
        $users = User::where('instalment', '!=', null)->paginate(30);
        return view('instalments')->with('users',$users);
    }

    public function delete_instalment($id)
    {
        $user = User::FindOrFail($id);
        $user->instalment = null;
        $user->save();
        return redirect()->back();
    }

    public function user_edit($id , request $request)
    {
        $this->Validate($request,[
            'username' => ['required','string','max:255',Rule::unique('users')->ignore($id)],
            'password' => 'nullable|string|min:6|confirmed',
            'acc_id'=> ['required','integer',Rule::unique('users')->ignore($id)],
            'is_admin' => 'required|boolean',
            'is_super_admin' => 'required|boolean',
            'f_name' => 'required','string','max:225',
            'l_name' => 'required','string','max:225',
            'phone_number' => 'required|digits:11',
            'faculty_number' => 'nullable|integer',
            'home_number' => 'nullable|integer',
            'email' => 'nullable|string|email|max:255',
            'relation' => 'nullable|string',
            'note' => 'nullable|string',
            'user_note' => 'nullable|string',
            'instalment' => 'nullable|integer',
            'instalment_force' => 'nullable|integer',
            'period' => 'nullable|string',
            'period_force' => 'nullable|string',
            'loan_row' => 'nullable|string',
            'loan_row_force' => 'nullable|string',
            'cheque' => 'nullable|string',
            'cheque_force' => 'nullable|string',
        ]);

        $data = User::FindOrFail($id);

        $data->username = $request['username'];
        $data->f_name = $request['f_name'];
        $data->l_name = $request['l_name'];
        $data->acc_id = $request['acc_id'];
        if (isset($request->password)){
            $data->password = bcrypt($request['password']);
        }
        $data->is_admin = $request['is_admin'];
        $data->is_super_admin = $request['is_super_admin'];
        $data->phone_number = $request['phone_number'];
        $data->faculty_number = $request['faculty_number'];
        $data->home_number = $request['home_number'];
        $data->relation = $request['relation'];
        $data->email = $request['email'];
        $data->note = $request['note'];
        $data->user_note = $request['user_note'];
        $data->instalment = $request['instalment'];
        $data->instalment_force = $request['instalment_force'];
        $data->period = $request['period'];
        $data->period_force = $request['period_force'];
        $data->loan_row = $request['loan_row'];
        $data->loan_row_force = $request['loan_row_force'];
        $data->cheque = $request['cheque'];
        $data->cheque_force = $request['cheque_force'];

        $data->save();

        return redirect(route('admin'));


    }
}
