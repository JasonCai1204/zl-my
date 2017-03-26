<?php

namespace App\Http\Controllers\api\Auth;

use App\Code;
use App\Patient;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected function register(Request $request)
    {

        if ($request->code == Code::where('phone_number',$request->phone_number)->value('code')){
            $time2 = Code::where('phone_number',$request->phone_number)->value('updated_at');
            $time1= Carbon::now();

            if ($time1->diffInSeconds($time2) > 120){

                return collect([
                    'status' => -1,
                    'msg' => '验证码已过期，请再次尝试。'
                ])->toJson();

            }
        }else {
            return collect([
                'status' => -1,
                'msg' => '验证码不正确，请再试一次。'
            ])->toJson();

        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|',
        ], [
            'name.required' => '姓名不能为空。',
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

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|digits:11|unique:users',
        ], [
            'phone_number.required' => '手机号码不能为空。',
            'phone_number.digits' => '请输入 11 位手机号码。',
            'phone_number.unique' => '此手机号码已注册',
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

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => '密码不能为空。',
            'password.min' => '密码不能少于 8 位。',
            'password.confirmed' => '确认密码与密码不相同。'
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

        $validator = Validator::make($request->all(), [
            'terms' => 'required'
        ], [
            'terms.required' => '同意《服务条款》后方可注册。',
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

        $patient = Patient::create([
            'name' => $request->name
        ]);

        User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
            'role_id' => $patient->id,
            'role_type' => 'App\Patient'
        ]);

        return collect([
            'status' => 1,
            'msg' => '注册成功'
        ])->toJson();

    }
}
