<?php

namespace App\Http\Controllers\api\Auth;

use App\Code;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends Controller
{
    public function forget(Request $request){

        $user = User::where('phone_number',$request->phone_number)->first();



        if ($request->has('code') && count($request->code)>0){
            if ($request->code == Code::where('phone_number',$request->phone_number)->value('code')){

                $time2 = Code::where('phone_number',$request->phone_number)->value('updated_at');

                $time1= Carbon::now();

                if ($time1->diffInSeconds($time2) > 120){
                    return collect([
                        'status' => -1,
                        'msg' => '验证码已过期，请再次尝试。'
                    ])->toJson();

                }

                $user->update(['password' => bcrypt($request->password)]);

                return collect([
                    'status' => 1,
                    'msg' => '密码重设成功。'
                ])->toJson();

            }else {
                return collect([
                    'status' => -1,
                    'msg' => '验证码不正确，请再试一次。'
                ])->toJson();

            }
        }else{
            $validator = Validator::make($request->all(), [
                'phone_number' => 'required|digits:11',
            ], [
                'phone_number.required' => '手机号码不能为空。',
                'phone_number.digits' => '请输入 11 位手机号码。',
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

            if (count($user)==0){
                return collect([
                    'status' => -1,
                    'msg' => '找不到您输入的手机号码，或者您的输入不正确。请再试一次。'
                ])->toJson();
            }

            $validator = Validator::make($request->all(), [
                'password' => 'required|min:6|confirmed',
            ], [
                'password.required' => '密码不能为空。',
                'password.min' => '密码不能少于 8 位。',
                'password.confirmed' => '密码与确认密码不相同，请再试一次。'
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

            return collect([
                'status' => 1,
                'msg' => '验证成功。'
            ])->toJson();

        }

    }
}
