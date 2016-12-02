<?php

namespace App\Http\Controllers\web\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
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

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|max:70',
            'phone_number' => 'required|digits:11|unique:users',
            'terms' => 'required',
            'password' => 'required|min:6|confirmed'
        ], [
            'name.required' => '姓名不能为空。',
            'name.max' => '姓名不能超过 70 位。',
            'phone_number.required' => '手机号码不能为空。',
            'phone_number.digits' => '手机号码必需是 11 位数字。',
            'phone_number.unique' => '此手机号码已注册',
            'terms.required' => '同意《服务条款》后方可注册。',
            'password.required' => '密码不能为空。',
            'password.min' => '密码不能少于 6 位。',
            'password.confirmed' => '确认密码与密码不相同。'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return view('web.auth.signup');
    }

}
