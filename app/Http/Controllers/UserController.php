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
            'name' => ['required','string','max:225',Rule::unique('users')->ignore($id)],
            'phone_number' => 'required|digits:11',
            'faculty_number' => 'nullable|digits:4',
            'home_number' => 'nullable|digits:11',
            'email' => 'nullable|string|email|max:255',
            'relation' => 'nullable|string',
            'note' => 'nullable|string',
            'instalment' => 'nullable|integer'
        ]);

        $data = User::FindOrFail($id);

        $data->username = $request['username'];
        $data->name = $request['name'];
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
        $data->instalment = $request['instalment'];

        $data->save();

        return redirect(route('admin'));


    }
}
