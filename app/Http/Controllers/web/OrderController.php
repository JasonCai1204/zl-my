<?php

namespace App\Http\Controllers\web;

use App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor', ['only' => 'getDoctorOrders']);
        $this->middleware('auth', ['only' => ['postCreate', 'getHospitalOrders']]);

    }

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
        if (isset($request->city_id))
            $data['city_id'] = $request->city_id;

        return view('web.orders.create', $data);
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
                'file' => [
                    "paths" => $paths
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
            $order->photos = $request->photos;
        }

        $order->save();

        return view('web.orders.message');

    }

    // Get doctor orders.
    public function getDoctorOrders(Request $request)
    {
        dd('ok');
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

    public function get(){
        dd('12345');
    }

}
