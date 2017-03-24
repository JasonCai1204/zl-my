<?php

namespace App\Http\Controllers\api;

use App;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['getProfile','modifyProfile']);
        $this->middleware('apiDoctor')->only(['getProfile','modifyProfile']);
    }

    public function index(Request $request)
    {
        $data = [];

        $doctors = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        if ($request->has('city_id') || $request->has('hospital_id') || $request->has('instance_id')){

            try {
                $c = App\City::findOrfail($request->city_id);
            } catch (ModelNotFoundException $e) {
                if ($request->has('city_id')) {
                }
            };

            try {
                $h = App\Hospital::findOrfail($request->hospital_id);
            } catch (ModelNotFoundException $e) {
                if ($request->has('hospital_id')) {
                }
            };

            try {
                $i = App\Instance::findOrfail($request->instance_id);
            } catch (ModelNotFoundException $e) {
                if ($request->has('instance_id')) {
                }
            };

            // Get doctors via city_id, hospital_id, instance_id.
            $d = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();
            $data = [];

            if (isset($c)) {
                $temp = collect([]);
                foreach ($c->hospitals as $hospital) {
                    $temp = $temp->merge($hospital->doctors);
                }
                $d = $d->intersect($temp);

            }

            if (isset($h)) {
                $d = $d->intersect($h->doctors);
            }


            if (isset($i)) {
                $d = $d->intersect($i->doctors);
            }

            foreach ($d as $doctor) {
                $info1 = [
                    'id' => $doctor->id,
                    'avatar' => count($doctor->avatar) > 0 ? $doctor->avatar :'images/doctor/avatar/default.png',
                    'name' => $doctor->name,
                    'grading' => $doctor->grading,
                    'hospital_id' => $doctor->hospital_id,
                    'is_certified' => $doctor->is_certified,
                    'hospital_name' => $doctor->hospital->name,
                ];

                $instances = [];

                foreach ($doctor->instances()->orderBy('sort')->get() as $instance) {
                    $instances[] = [
                        'id' => $instance->id,
                        'name' => $instance->name
                    ];
                }

                $data['doctors'][] = array_merge($info1, ['instances' => $instances]);
            }

            return collect([
                'status' => 1,
                'msg' => '加载成功',
                'data' => isset($data['doctors']) && count($data['doctors'])>0 ? $data : ['doctors' => $data]
            ]);


        }

        foreach ($doctors as $doctor) {
            $info1 = [
                'id' => $doctor->id,
                'avatar' => count($doctor->avatar) > 0 ? $doctor->avatar :'images/doctor/avatar/default.png',
                'name' => $doctor->name,
                'grading' => $doctor->grading,
                'hospital_id' => $doctor->hospital_id,
                'is_certified' => $doctor->is_certified,
                'hospital_name' => $doctor->hospital->name,
            ];

            $instances = [];

            foreach ($doctor->instances()->orderBy('sort')->get() as $instance) {
                $instances[] = [
                    'id' => $instance->id,
                    'name' => $instance->name
                ];
            }

            $data['doctors'][] = array_merge($info1, ['instances' => $instances]);
        }


        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => $data
        ])->toJson();

    }

    public function detail(Request $request)
    {
        $introduction = App\Doctor::findOrFail($request->doctor_id)->introduction;

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => [
                'introduction' => $introduction
            ]
        ])->toJson();
    }


//Select doctor
    public function getSelect(Request $request)
    {
        $data = [];

        foreach (App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get() as $city){
            $data['cities'][] = [
                'id' => $city->id,
                'name' => $city->name
            ];
        }

        foreach (App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get() as $hospital){
            $data['hospitals'][] = [
                'id' => $hospital->id,
                'name' => $hospital->name,
                'grading' => $hospital->grading,
                'is_recommended' => $hospital->is_recommended,
                'city_id' => $hospital->city->id,
                'city_name' => $hospital->city->name
            ];
        }

        foreach (App\Type::orderBy('id')->get() as $type){
            $info1 = [
                'id' => $type->id,
                'name' => $type->name
            ];

            $instances = [];

            foreach ($type->instances()->orderBy('sort')->get() as $instance){
                $instances[] = [
                    'id' => $instance->id,
                    'name' => $instance->name,
                    'type_id' => $instance->type_id,
                    'sort' => $instance->sort
                ];
            }

            $data['instances'][] = array_merge($info1,['instances' => $instances]);
        }

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => $data
        ])->toJson();
    }


// Doctor profile.
    public function getProfile(Request $request)
    {
        $user = Auth::user()->toArray();

        $user_profile = array_only($user,['id','name','phone_number']);

        $doctor = App\Doctor::where('id',Auth::user()->role_id)->first()->toArray();

        $doctor_avatar = array_only($doctor,'avatar');

        $data = array_merge($user_profile,$doctor_avatar);

        return collect([
            'status' => 1,
            'msg' => '用户信息获取成功',
            'data' => $data
        ]);
    }

// Doctor modify profile

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
                    'msg' => '当前密码错误'
                ])->toJson();
            }
        }

        if ($request->has('phone_number')){

            $validator = Validator::make($request->all(), [
                'phone_number' => 'required|digits:11|unique:users,phone_number,' . $user->id,
            ], [
                'phone_number.required' => '手机号码不能为空。',
                'phone_number.digits' => '请输入 11 位手机号码。',
                'phone_number.unique' => '此手机号码已注册。',
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

            if ($request->code == App\Code::where('phone_number',$request->phone_number)->value('code')){
                $time2 = App\Code::where('phone_number',$request->phone_number)->value('updated_at');
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


            $user->phone_number = $request->phone_number;
            $user->save();

            return collect([
                'status' => 1,
                'msg' => '手机号码已更改。',
            ]);

        }

    }

}
