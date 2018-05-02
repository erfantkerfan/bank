<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function username()
    {
        return 'username';
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath($user));
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    public function redirectPath($user)
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($user);
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    public function redirectTo($user)
    {
        $id = $user->id;
        return '/admin/'.$id;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('AdminAuth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'acc_id'=> 'required|integer|unique:users',
            'is_admin' => 'required|boolean',
            'is_super_admin' => 'required|boolean',
            'f_name' => 'required|string|max:225',
            'l_name' => 'required|string|max:225',
            'phone_number' => 'required|digits:11',
            'faculty_number' => 'nullable|integer',
            'home_number' => 'nullable|integer',
            'email' => 'nullable|string|email|max:255',
            'relation' => 'nullable|string',
            'note' => 'Nullable|string',
            'instalment' => 'nullable|integer',
            'instalment_force' => 'nullable|integer',
            'period' => 'nullable|string',
            'period_force' => 'nullable|string',
            'loan_row' => 'nullable|string',
            'loan_row_force' => 'nullable|string',
            'Cheque' => 'nullable|string',
            'Cheque_force' => 'nullable|string',
            'start_date' => 'nullable|string',
            'end_date' => 'nullable|string',
            'start_date_force' => 'nullable|string',
            'end_date_force' => 'nullable|string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'acc_id' => $data{'acc_id'},
            'password' => bcrypt($data['password']),
            'is_admin' => $data['is_admin'],
            'is_super_admin' => $data['is_super_admin'],
            'f_name' => $data['f_name'],
            'l_name' => $data['l_name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'faculty_number' => $data['faculty_number'],
            'home_number' => $data['home_number'],
            'relation' => $data['relation'],
            'note' => $data['note'],
            'instalment' => $data['instalment'],
            'instalment_force' => $data['instalment_force'],
            'period' => $data['period'],
            'period_force' => $data['period_force'],
            'loan_row' => $data['loan_row'],
            'loan_row_force' => $data['loan_row_force'],
            'Cheque' => $data['Cheque'],
            'Cheque_force' => $data['Cheque_force'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'start_date_force' => $data['start_date_force'],
            'end_date_force' => $data['end_date_force'],
        ]);
        return ($user);
    }
}
