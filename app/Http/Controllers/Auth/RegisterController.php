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
            ?: redirect($this->redirectPath());
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
            'name' => 'required|string|max:225|unique:users',
            'phone_number' => 'required|digits:11',
            'faculty_number' => 'nullable|digits:11',
            'home_number' => 'nullable|digits:11',
            'email' => 'nullable|string|email|max:255',
            'relation' => 'nullable|string',
            'note' => 'Nullable|string',
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
        return User::create([
            'username' => $data['username'],
            'acc_id' => $data{'acc_id'},
            'password' => bcrypt($data['password']),
            'is_admin' => $data['is_admin'],
            'is_super_admin' => $data['is_super_admin'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'faculty_number' => $data['faculty_number'],
            'home_number' => $data['home_number'],
            'relation' => $data['relation'],
            'note' => $data['note']
        ]);
    }
}
