<?php

namespace App\Http\Controllers\api;

use App\Code;
use App\Doctor;
use App\Master;
use App\Patient;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

        // Get profile.
    public function getProfile(Request $request)
    {
        $user = Auth::user()->toArray();

        $data = array_only($user,['id','name','phone_number']);

        return collect([
            'status' => 1,
            'msg' => '用户信息获取成功',
            'data' => $data
        ]);
    }

    // Post modify profile.
    public function modifyProfile(Request $request)
    {
        $user = Auth::user();

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

            if (Hash::check($request->current_password, $user->password)) {

                return collect([
                    'status' => 1,
                    'msg' => '密码正确'
                ])->toJson();
            } else {
                return collect([
                    'status' => -1,
                    'msg' => '密码不正确，请再试一次。'
                ])->toJson();
            }
        }


        if ($request->has('phone_number') && !$request->has('code')){
            $validator = Validator::make($request->all(), [
                'phone_number' => 'required|digits:11|unique:users,phone_number,'
            ], [
                'phone_number.required' => '手机号码不能为空。',
                'phone_number.digits' => '请输入 11 位手机号码。',
                'phone_number.unique' => '此号码已注册，请更换其他号码或用此号码来登录。',
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
                'msg' => '验证通过。',
            ]);

        }


        if ($request->has('phone_number') && $request->has('code')){

            if ($request->code == Code::where('phone_number',$request->phone_number)->value('code')){
                $time2 = Code::where('phone_number',$request->phone_number)->value('updated_at');
                $time1= Carbon::now();

                if ($time1->diffInSeconds($time2) > 120){

                    return collect([
                        'status' => -1,
                        'msg' => '验证码已过期，请再次尝试。'
                    ])->toJson();

                }

                $user->phone_number = $request->phone_number;
                $user->save();

                return collect([
                    'status' => 1,
                    'msg' => '手机号码已更改。',
                ]);
            }else {
                return collect([
                    'status' => -1,
                    'msg' => '验证码不正确，请再试一次。'
                ])->toJson();

            }

        }


        if ($request->has('name')){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:5',
            ], [
                'name.required' => '姓名不能为空。',
                'name.max' => '姓名不能超过 5 位。',
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

            if ($user->role_type == 'App\Doctor'){

                return collect([
                    'status' => -1,
                    'msg' => '医生暂不能更改姓名。如需更改，请联系客服：4008-120-533。',
                ]);
            }


            $user->name = $request->name;
            $user->save();

            if ($user->role_type == 'App\Patient'){
                Patient::find($user->role_id)->update(['name' => $request->name]);

            }


            if ($user->role_type == 'App\Master'){
                Master::find($user->role_id)->update(['name' => $request->name]);

            }

            return collect([
                'status' => 1,
                'msg' => '姓名已更改。',
            ]);

        }
    }

}
