<?php

namespace App\Http\Controllers\cms\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('auth');
    }

    public function showResetForm()
    {
        return view('cms.auth.passwords.reset');
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = $this->guard()->user();
        if (Hash::check($request->current_password, $user->password)) {

            $user->password = bcrypt($request->password);

            $user->save();

            return redirect('/');
        } else {
            return redirect()->back()
                ->withErrors([
                    'current_password' => '当前密码错误。'
                ]);
        }

        $this->guard()->login($user);
    }

    protected function guard()
    {
        return Auth::guard();
    }

}
