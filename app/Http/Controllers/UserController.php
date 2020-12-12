<?php

namespace App\Http\Controllers;

use App\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::query()->findOrFail($id);
        return view('user_edit')->with(['user' => $user]);
    }

    public function setpasswordform()
    {
        return view('setpassword');
    }

    public function setpassword(request $request)
    {
        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {

            return Hash::check($value, current($parameters));

        });
        $this->Validate($request, [
            'oldpassword' => 'required|old_password:' . auth()->user()->password,
            'password' => 'nullable|string|min:6|confirmed'
        ]);
        $user = User::query()->findOrFail(auth()->id());
        $user->password = bcrypt($request['password']);
        $user->save();
        return redirect(route('home'));
    }

    public function normal_instalments(Request $request)
    {
        $users = User::where('instalment', '!=', null)->OrderBy($request->sort ? $request->sort : 'acc_id')->paginate(30);
        return view('normal_instalments')->with(['users' => $users]);
    }

    public function force_instalments(Request $request)
    {
        $users_force = User::where('instalment_force', '!=', null)->OrderBy($request->sort ? $request->sort : 'acc_id')->paginate(30);
        return view('force_instalments')->with(['users_force' => $users_force]);
    }

    public function delete_instalment($id)
    {
        $user = User::query()->findOrFail($id);
        $user->instalment = null;
        $user->period = null;
        $user->loan_row = null;
        $user->cheque = null;
        $user->start_date = null;
        $user->end_date = null;
        $user->save();
        return back();
    }

    public function delete_instalment_force($id)
    {
        $user = User::query()->findOrFail($id);
        $user->instalment_force = null;
        $user->period_force = null;
        $user->loan_row_force = null;
        $user->cheque_force = null;
        $user->start_date_force = null;
        $user->end_date_force = null;
        $user->save();
        return back();
    }

    public function user_edit($id, request $request)
    {
        $this->Validate($request, [
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => 'nullable|string|min:6|confirmed',
            'acc_id' => ['required', 'integer', Rule::unique('users')->ignore($id)],
            'is_admin' => 'required|boolean',
            'is_super_admin' => 'required|boolean',
            'f_name' => 'required', 'string', 'max:225',
            'l_name' => 'required', 'string', 'max:225',
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
            'start_date' => 'nullable|string',
            'start_date_force' => 'nullable|string',
            'active' => 'nullable|boolean',
        ]);

        $data = User::query()->findOrFail($id);

        $data->username = $request['username'];
        $data->f_name = $request['f_name'];
        $data->l_name = $request['l_name'];
        $data->acc_id = $request['acc_id'];
        if (isset($request->password)) {
            $data->password = bcrypt($request['password']);
        }
        $data->is_admin = $request['is_admin'];
        $data->is_super_admin = $request['is_super_admin'];
        $data->phone_number = $request['phone_number'];
        $data->faculty_number = $request['faculty_number'];
        $data->home_number = $request['home_number'];
        $data->relation = $request['relation'];
        $data->email = $request['email'];
        if ($data->note != $request['note']) {
            $data->note_date = Verta::now();
        }
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
        $data->start_date = $request['start_date'] ? Verta::parse($request['start_date'])->format('Y-m-d') : $request['start_date'];
        $end_date = null;
        if ($data['start_date'] != null && $data['period'] != null) {
            $end_date = str_replace('-', '/', Verta::parse($data->start_date)->addMonths(($data->period) - 1)->format('Y-m-d'));
        }
        $data->end_date = $end_date;
        $data->start_date_force = $request['start_date_force'] ? Verta::parse($request['start_date_force'])->format('Y-m-d') : $request['start_date_force'];
        $end_date_force = null;
        if ($data['start_date_force'] != null && $data['period_force'] != null) {
            $end_date_force = str_replace('-', '/', Verta::parse($data->start_date_force)->addMonths(($data->period_force) - 1)->format('Y-m-d'));
        }
        $data->end_date_force = $end_date_force;
        $data->active = $request['active'];

        $data->save();

        if ($request['url2'] == 'admin') {
            return redirect(route('admin'));
        } else {
            return redirect('/admin/' . $id);
        }
    }
}
