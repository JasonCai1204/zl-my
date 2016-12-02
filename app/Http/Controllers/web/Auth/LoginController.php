<?php

namespace App\Http\Controllers\web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function username()
    {
        return 'phone_number';
    }

    public function showLoginForm()
    {
        return view('web.auth.login');
    }

    protected function validateLogin(Request $request)
    {
        Validator::make($request->all(), [
            $this->username() => 'required',
            'password' => 'required'
        ], [
            $this->username() . '.required' => '手机号码不能为空。',
            'password.required' => '密码不能为空。'
        ])->validate();
    }
}
