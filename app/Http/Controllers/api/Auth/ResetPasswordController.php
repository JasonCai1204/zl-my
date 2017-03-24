<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function reset(Request $request)
    {
        if ($request->current_password && count($request->current_password)>0){
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
            ], [
                'current_password.required' => '当前密码不能为空。',
            ]);

            if ($validator->fails()){

                $errors = $validator->errors()->all();

                foreach ($errors as $error){
                    $error;
                }

                return collect([
                    'status' => -1,
                    'msg' => $error
                ])->toJson();

            }

            $user = Auth::user();

            if (Hash::check($request->current_password, $user->password)) {

                return collect([
                    'status' => 1,
                    'msg' => '密码正确'
                ])->toJson();
            } else {
                return collect([
                    'status' => -1,
                    'msg' => '当前密码错误'
                ])->toJson();
            }
        }else {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:6|confirmed'
            ], [
                'password.required' => '新密码不能为空。',
                'password.min' => '新密码不能小于 8 位',
                'password.confirmed' => '确认密码与新密码不一致。'
            ]);

            if ($validator->fails()){

                $errors = $validator->errors()->all();

                foreach ($errors as $error){
                    $error;
                }

                return collect([
                    'status' => -1,
                    'msg' => $error
                ])->toJson();

            }

            $user = Auth::user();

            $user->update(['password' => bcrypt($request->password)]);

            return collect([
                'status' => 1,
                'msg' => '密码已重设'
            ])->toJson();
        }

    }

    protected function guard()
    {
        return Auth::guard();
    }
}
