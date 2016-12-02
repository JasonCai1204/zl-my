<?php

namespace App\Http\Controllers\web;

use App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'getCreate']);
    }

    //redirect order/create
    public function getCreate(Request $request)
    {

        if($request->hospital_id && $request->doctor_id && $request->instance_id){

            $hospitals = App\Hospital::where('id', $request->hospital_id)
                    ->get();

            $doctors = App\Doctor::where('id',$request->doctor_id)
                    ->get();

            $instances = App\Instance::where('id',$request->instance_id)
                    ->get();

            return view('users.orders.create', [
                'hospitals' => $hospitals,
                'hospital_id' => $request->hospital_id,
                'doctors' => $doctors,
                'doctor_id' => $request->doctor_id,
                'instances' => $instances,
                'instance_id' => $request->instance_id
            ]);
        }

        if($request->hospital_id && $request->doctor_id){

            $hospitals = App\Hospital::where('id', $request->hospital_id)
                    ->get();

            $doctors = App\Doctor::where('id', $request->doctor_id)
                    ->get();

            return view('users.orders.create', [
                'hospitals' => $hospitals,
                'hospital_id' => $request->hospital_id,
                'doctors' => $doctors,
                'doctor_id'=> $request->doctor_id
            ]);
        }

        if($request->hospital_id ) {
            $hospitals = App\Hospital::where('id', $request->hospital_id)
                    ->get();

            return view('users.orders.create', [
                'hospitals' => $hospitals,
                'hospital_id' => $request->hospital_id
            ]);
        }

        // Select from doctor

        if($request->doctor_id && !$request->instance_id){

            $doctors = App\Doctor::where('id',$request->doctor_id)
                    ->get();

            $hospital_id = App\Doctor::find($request->doctor_id)
                    ->hospital->id;

            $hospitals = App\Hospital::where('id',$hospital_id)
                    ->get();

            return view('users.orders.create', [
                'hospitals' => $hospitals,
                'hospital_id' => $hospital_id,
                'doctors' => $doctors,
                'doctor_id' => $request->doctor_id,
            ]);
        }

        // Select from instance
            if($request->instance_id && !$request->doctor_id){

                $instances = App\Instance::where('id',$request->instance_id)
                        ->get();

                return view('users.orders.create', [
                    'instances' => $instances,
                    'instance_id' => $request->instance_id
                ]);
            }

            if($request->instance_id && $request->doctor_id){

                $instances = App\Instance::where('id',$request->instance_id)
                        ->get();

                $doctors = App\Doctor::where('id',$request->doctor_id)
                        ->get();

                $hospital_id =  $doctors->first()->hospital->id;

                $hospitals = App\Hospital::where('id',$hospital_id)
                        ->get();

                return view('users.orders.create', [
                    'hospitals' => $hospitals,
                    'hospital_id' => $hospital_id,
                    'doctors' => $doctors,
                    'doctor_id' => $request->doctor_id,
                    'instances' => $instances,
                    'instance_id' => $request->instance_id
                ]);

            }

        return view('users.orders.create');
    }

    // User post photos
    public function postPhotos(Request $request)
    {
        // Save image to storage and get path.
        if ($request->hasFile('file') && $request->file->isValid()) {

             $path =  $request->file->storeAs('images/order/photos/' . Carbon::now()->timestamp, $request->file->getClientOriginalName(), 'public');

            $fileName = $request->file->getClientOriginalName();

            return collect([
                'file' => [
                    "name" => $fileName,
                    "url" => $path
                ]
            ])->toJson();

        }

    }

    // Post new order by user.
    public function postCreate(Request $request)
    {
        if($input =$request->all() ){
            $rules = [
                'patient_name' => 'required|max:5',
                'phone_number' => 'required|digits:11',
            ];

            $messages = [
                'patient_name.required' => '请输入姓名',
                'patient_name.max' => '患者姓名长度不能超过 5 位',
                'phone_number.required' => '请输入电话号码',
                'phone_number.digits' => '请输入 11 位数字'
            ];

            $validator = Validator::make($input,$rules,$messages);

            if($validator->passes()){
                $order = App\Order::create
                (
                    [
                        'patient_name' => $request->patient_name,
                        'phone_number' => $request->phone_number,
//                        'user_id' => session('user.id'),
                        'user_id' => 1,
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
                    $order->birthday = $request->birthday . "-01";

                if ($request->has('smoking'))
                    $order->smoking = $request->smoking;

                if ($request->has('weight'))
                    $order->weight = $request->weight;

                if ($request->has('wechat_id'))
                    $order->wechat_id = $request->wechat_id;

                if ($request->has('detail'))
                    $order->detail = $request->detail;

                if ($request->has('photos'))
                {
                    $order->photos = explode(",", $request->photos);
                }

                $order->save();

                return view('users.orders.message');

            }else{
                return back()->withErrors($validator);
            }

        }

    }

}
