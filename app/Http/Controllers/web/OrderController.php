<?php

namespace App\Http\Controllers\web;

use App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor', ['only' => 'getDoctorOrders']);
        $this->middleware('auth', ['only' => ['getCreate', 'getHospitalOrders']]);

    }


    //redirect order/create
    public function getCreate(Request $request)
    {

        if ($request->hospital_id && $request->doctor_id && $request->instance_id) {

            $hospitals = App\Hospital::where('id', $request->hospital_id)
                ->get();

            $doctors = App\Doctor::where('id', $request->doctor_id)
                ->get();

            $instances = App\Instance::where('id', $request->instance_id)
                ->get();

            return view('web.orders.create', [
                'hospitals' => $hospitals,
                'hospital_id' => $request->hospital_id,
                'doctors' => $doctors,
                'doctor_id' => $request->doctor_id,
                'instances' => $instances,
                'instance_id' => $request->instance_id
            ]);
        }

        if ($request->hospital_id && $request->doctor_id) {

            $hospitals = App\Hospital::where('id', $request->hospital_id)
                ->get();

            $doctors = App\Doctor::where('id', $request->doctor_id)
                ->get();

            return view('web.orders.create', [
                'hospitals' => $hospitals,
                'hospital_id' => $request->hospital_id,
                'doctors' => $doctors,
                'doctor_id' => $request->doctor_id
            ]);
        }

        if ($request->hospital_id) {

            $hospitals = App\Hospital::where('id', $request->hospital_id)
                ->get();

            return view('web.orders.create', [
                'hospitals' => $hospitals,
                'hospital_id' => $request->hospital_id
            ]);
        }

        // Select from doctor

        if ($request->doctor_id && !$request->instance_id) {

            $doctors = App\Doctor::where('id', $request->doctor_id)
                ->get();

            $hospital_id = App\Doctor::find($request->doctor_id)
                ->hospital->id;

            $hospitals = App\Hospital::where('id', $hospital_id)
                ->get();

            return view('web.orders.create', [
                'hospitals' => $hospitals,
                'hospital_id' => $hospital_id,
                'doctors' => $doctors,
                'doctor_id' => $request->doctor_id,
            ]);
        }

        // Select from instance
        if ($request->instance_id && !$request->doctor_id) {

            $instances = App\Instance::where('id', $request->instance_id)
                ->get();

            return view('web.orders.create', [
                'instances' => $instances,
                'instance_id' => $request->instance_id
            ]);
        }

        if ($request->instance_id && $request->doctor_id) {

            $instances = App\Instance::where('id', $request->instance_id)
                ->get();

            $doctors = App\Doctor::where('id', $request->doctor_id)
                ->get();

            $hospital_id = $doctors->first()->hospital->id;

            $hospitals = App\Hospital::where('id', $hospital_id)
                ->get();

            return view('web.orders.create', [
                'hospitals' => $hospitals,
                'hospital_id' => $hospital_id,
                'doctors' => $doctors,
                'doctor_id' => $request->doctor_id,
                'instances' => $instances,
                'instance_id' => $request->instance_id
            ]);

        }

        return view('web.orders.create');
    }

    // User post photos
    public function postPhotos(Request $request)
    {
        // Save image to storage and get path.
        if ($request->hasFile('file') && $request->file->isValid()) {

            $path = $request->file->storeAs('images/order/photos/' . Carbon::now()->timestamp, $request->file->getClientOriginalName(), 'public');

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
        $this->validate($request, [
            'patient_name' => 'required|max:5',
            'phone_number' => 'required|digits:11',
        ], [
            'patient_name.required' => '姓名不能为空。',
            'patient_name.max' => '患者姓名长度不能超过 5 位。',
            'phone_number.required' => '手机号码不能为空。',
            'phone_number.digits' => '请输入 11 位手机号码。',
        ]);

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
            $order->birthday = $request->birthday . "-01";

        if ($request->has('smoking'))
            $order->smoking = $request->smoking;

        if ($request->has('weight'))
            $order->weight = $request->weight;

        if ($request->has('wechat_id'))
            $order->wechat_id = $request->wechat_id;

        if ($request->has('detail'))
            $order->detail = $request->detail;

        if ($request->has('photos')) {
            $order->photos = explode(",", $request->photos);
        }

        $order->save();

        return view('web.orders.message');


    }

    // Get doctor orders.
    public function getDoctorOrders(Request $request)
    {
        $orders = Auth::guard('doctor')->user()->orders()->where('send_to_the_doctor_at', '!=', null)->get();

        if (count($orders) < 0) {
            return view('web.orders.doctors');
        }

        return view('web.orders.doctors', [
            'orders' => $orders
        ]);
    }

    // Get hospital orders.
    public function getHospitalOrders(Request $request)
    {
        $orders = App\Order::where('user_id', Auth::user()->id)
            ->get();

        return view('web.orders.users', [
            'orders' => $orders
        ]);
    }

}
