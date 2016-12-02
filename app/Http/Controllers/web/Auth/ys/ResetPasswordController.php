<?php

namespace App\Http\Controllers\web\Auth\ys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class ResetPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:doctor');
    }

    public function showResetForm(Request $request)
    {
        return view('web.auth.ys.passwords.reset');
    }

    public function reset(Request $request)
    {
        Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed'
        ], [
            'current_password.required' => '当前密码不能为空。',
            'password.required' => '新密码不能为空。',
            'password.min' => '新密码不能小于 6 位',
            'password.confirmed' => '确认密码与新密码不一致。'
        ])->validate();

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
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
