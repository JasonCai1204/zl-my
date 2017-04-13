<?php

namespace App\Http\Controllers\api;

use App\Http\Hospital;
use App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['getDoctorOrders','report','postCreate','getUserOrders','updateOrders']);

        $this->middleware('apiDoctor')->only(['getDoctorOrders','report']);
    }

    //redirect order/create
    public function getCreate(Request $request)
    {
        try {
            $c =App\City::findOrFail($request->city_id);
        } catch (ModelNotFoundException $e) {

        }

        try {
            $h = App\Hospital::findOrFail($request->hospital_id);
        } catch (ModelNotFoundException $e) {

        }
        try {
            $d = App\Doctor::findOrFail($request->doctor_id);
        } catch (ModelNotFoundException $e) {

        }
        try {
            $i = App\Instance::findOrFail($request->instance_id);
        } catch (ModelNotFoundException $e) {

        }

        // unset
        // 1. h & d
        // 2. d & i
        // 3. h & i

        if (isset($c) && isset($h) && $c->id != $h->city_id)
            unset($h);

        if (isset($h) && isset($d) && $h->id != $d->hospital_id)
            unset($d);

        if (isset($d) && isset($i) && !$d->instances->contains($i))
            unset($i);

        if (isset($h) && isset($i)) {
            $ins = [];
            foreach ($h->doctors as $doctor) {
                foreach ($doctor->instances as $instance) {
                    $ins[] = $instance->id;
                }
            }
            if (!in_array($i->id, $ins)) {
                unset($i);
            }
        }

        // package
        $data = [];
        if (isset($c))
            $data['city'] = $c;
        if (isset($h))
            $data['hospital'] = $h;
        if (isset($d))
            $data['doctor'] = $d;
        if (isset($i))
            $data['instance'] = $i;

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => $data
        ])->toJson();
    }

    // User post photos
    public function postPhotos(Request $request)
    {
        if ($request->hasFile('photos')) {

            $paths = [];
            foreach ($request->photos as $photo) {
                $paths[] = $photo->storeAs('images/order/photos/' . Carbon::now()->timestamp, $photo->getClientOriginalName(), 'public');
            }

            return collect([
                'status' => 1,
                'msg' => '加载成功',
                'data' => $paths
            ])->toJson();

        }

    }

    // Post new order by user.
    public function postCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_name' => 'required|max:5',
        ], [
            'patient_name.required' => '姓名不能为空。',
            'patient_name.max' => '患者姓名不能多于 5 个字。'
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
            'phone_number' => 'required|digits:11',
        ], [
            'phone_number.required' => '手机号码不能为空。',
            'phone_number.digits' => '请输入 11 位手机号码。'
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


        $order = App\Order::create
        (
            [
                'patient_name' => $request->patient_name,
                'phone_number' => $request->phone_number,
                'user_id' => Auth::user()->id,
            ]
        );

        if ($request->has('hospital_id'))
            $order->hospital_id = $request->hospital_id;

        if ($request->has('doctor_id'))
            $order->doctor_id = $request->doctor_id;

        if ($request->has('instance_id'))
            $order->instance_id = $request->instance_id;

        if ($request->has('gender'))
            $order->gender = $request->gender;

        if ($request->has('birthday'))
            $order->birthday = $request->birthday . '-01';

        if ($request->has('smoking'))
            $order->smoking = $request->smoking;

        if ($request->has('weight'))
            $order->weight = $request->weight;

        if ($request->has('wechat_id'))
            $order->wechat_id = $request->wechat_id;

        if ($request->has('detail'))
            $order->detail = $request->detail;

        if ($request->has('photos')) {
            $order->photos = $request->photos;
        }

        $order->save();


        return collect([
            'status' => 1,
            'msg' => '订单提交成功。',
        ])->toJson();

    }

    // Get User orders.
    public function getUserOrders(Request $request)
    {

        $orders = App\Order::where('user_id', Auth::user()->id)
            ->orderBy('created_at','desc')
            ->get();
        $data = [];

        foreach ($orders as $order){
            $data['orders'][] = [
                'id' => $order->id,
                'patient_name' => $order->patient_name,
                'phone_number' => $order->phone_number,
                'hospital_id' => $order->hospital_id,
                'hospital_name' => $order->hospital_id ? App\Hospital::find($order->hospital_id)->name : null,
                'hospital_avatar' => $order->hospital_id && count(App\Hospital::find($order->hospital_id)->avatar) > 0 ? App\Hospital::find($order->hospital_id)->avatar :'images/hospital/avatar/default.png',
                'doctor_id' => $order->doctor_id,
                'doctor_name' => $order->doctor_id ? App\Doctor::find($order->doctor_id)->name : null,
                'doctor_avatar' => $order->doctor_id && count(App\Doctor::find($order->doctor_id)->avatar) > 0 ? App\Doctor::find($order->doctor_id)->avatar :'images/doctor/avatar/default.png',
                'instance_id' => $order->instance_id,
                'instance_name' => $order->instance_id ? App\Instance::find($order->instance_id)->name : null,
                'gender' => $order->gender === null  ? $order->gender = -1 : $order->gender,
                'birthday' => isset($order->birthday) && count($order->birthday) >0 ? substr($order->birthday,0,-3) : $order->birthday,
                'smoking' => $order->smoking === null  ? $order->smoking = -1 : $order->smoking,
                'weight' => $order->weight,
                'wechat_id' => $order->wechat_id,
                'detail' => $order->detail,
                'photos' => $order->photos,
                'created_at' => $order->created_at->format('Y-m-d')
            ];
        }

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => count($data) > 0 ? $data : null
        ])->toJson();

    }

    // Update User orders.

    public function updateOrders(Request $request){


        $order = App\Order::find($request->order_id);

        $this->validate($request, [
            'patient_name' => 'required|max:5',
            'phone_number' => 'required|digits:11',
        ], [
            'patient_name.required' => '姓名不能为空。',
            'patient_name.max' => '患者姓名长度不能超过 5 位。',
            'phone_number.required' => '手机号码不能为空。',
            'phone_number.digits' => '请输入 11 位手机号码。',
        ]);

        if ($request->has('patient_name'))
            $order->patient_name = $request->patient_name;

        if ($request->has('phone_number'))
            $order->phone_number = $request->phone_number;

        if ($request->has('user_id'))
            $order->user_id = Auth::user()->id;

        if ($request->has('hospital_id'))
            $order->hospital_id = $request->hospital_id;

        if ($request->has('doctor_id'))
            $order->doctor_id = $request->doctor_id;

        if ($request->has('instance_id'))
            $order->instance_id = $request->instance_id;

        if ($request->has('gender'))
            $order->gender = $request->gender;

        if ($request->has('birthday'))
            $order->birthday = $request->birthday . '-01';

        if ($request->has('smoking'))
            $order->smoking = $request->smoking;

        if ($request->has('weight'))
            $order->weight = $request->weight;

        if ($request->has('wechat_id'))
            $order->wechat_id = $request->wechat_id;

        if ($request->has('detail'))
            $order->detail = $request->detail;

        if ($request->has('photos')) {
            $order->photos = $request->photos;
        }

        $order->save();

        return collect([
            'status' => 1,
            'msg' => '订单已保存。',
        ])->toJson();
    }


    // Get Doctor orders.
    public function getDoctorOrders(Request $request)
    {
        $orders = App\Order::where('doctor_id',Auth::user()->role_id)
            ->where('send_to_the_doctor_at', '!=', null)
            ->orderBy('send_to_the_doctor_at','desc')
            ->get();

        $data = [];

        foreach ($orders as $order){
            $data['orders'][] = [
                'id' => $order->id,
                'patient_name' => $order->patient_name,
                'phone_number' => $order->phone_number,
                'hospital_id' => $order->hospital_id,
                'hospital_name' => $order->hospital_id ? App\Hospital::find($order->hospital_id)->name : null,
                'doctor_id' => $order->doctor_id,
                'doctor_name' => $order->doctor_id ? App\Doctor::find($order->doctor_id)->name : null,
                'instance_id' => $order->instance_id == 0 ? null : $order->instance_id,
                'instance_name' => $order->instance_id ? App\Instance::find($order->instance_id)->name : null,
                'gender' => $order->gender === null  ? $order->gender = -1 : $order->gender,
                'birthday' => isset($order->birthday) && count($order->birthday) >0 ? substr($order->birthday,0,-3) : $order->birthday,
                'smoking' => $order->smoking === null  ? $order->smoking = -1 : $order->smoking,
                'weight' => $order->weight,
                'wechat_id' => $order->wechat_id,
                'detail' => $order->detail,
                'photos' => $order->photos,
                'created_at' => $order->send_to_the_doctor_at->format('Y-m-d'),
                'condition_report' => $order->condition_report ? $order->condition_report : null
            ];
        }


        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => count($data) > 0 ? $data : null
        ]);

    }


    public function report(Request $request){

        $report = App\Order::find($request->order_id)->condition_report;

        return view('api/condition-report',['report' => $report]);

    }



    public function judge(Request $request)
    {
        try {
            $h = App\Hospital::findOrFail($request->hospital_id);
        } catch (ModelNotFoundException $e) {

        }
        try {
            $i = App\Instance::findOrFail($request->instance_id);
        } catch (ModelNotFoundException $e) {

        }

        if (isset($h) && isset($i)) {
            $ins = [];
            foreach ($h->doctors as $doctor) {
                foreach ($doctor->instances as $instance) {
                    $ins[] = $instance->id;
                }
            }
            if (!in_array($i->id, $ins)) {
                unset($i);
            }
        }

        // package
        $data = [];

        if (isset($i))
            $data['instance'] = $i;

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => count($data) > 0 ? 1 : 0
        ])->toJson();

    }

}
