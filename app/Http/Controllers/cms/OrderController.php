<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:master');
    }

    public function index()
    {
        return view('cms.orders.index', ['data' => App\Order::all()]);
    }

    public function show(App\Order $order)
    {
        return view('cms.orders.show', [
            'data' => $order,
            'types' => App\Type::orderBy('sort')->get(),
            'hospitals' => App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get()
        ]);
    }

    public function update(Request $request, App\Order $order)
    {
        $this->validate($request, [
            'patient_name' => 'required|max:5',
            'phone_number' => 'required|digits:11',
            'instance_id' => 'exists:instances,id',
            'birthday' => 'date',
            'weight' => 'max:6',
            'wechat_id' => 'max:20'
        ]);

        $hospital_id = $doctor_id = null;
        if ($request->has('hospital_id_or_doctor_id')) {
            $hospital_id_or_doctor_id = explode(',', $request->hospital_id_or_doctor_id);
            // validate hospital id
            $hospital_id = $hospital_id_or_doctor_id[0];
            Validator::make([
                'hospital_id' => $hospital_id
            ], [
                'hospital_id' => 'required|exists:hospitals,id'
                ])->validate();
                // validate doctor id
                if (isset($hospital_id_or_doctor_id[1])) {
                    $doctor_id = $hospital_id_or_doctor_id[1];
                    Validator::make([
                        'doctor_id' => $doctor_id
                    ], [
                        'doctor_id' => 'required|exists:doctors,id'
                        ])->validate();
                    }

                }

                $order->patient_name = $request->patient_name;
                $order->phone_number = $request->phone_number;
                $order->instance_id = $request->instance_id ?: null;
                $order->hospital_id = $hospital_id ?: null;
                $order->doctor_id = $doctor_id ?: null;
                $order->gender = $request->gender;
                $order->birthday = new Carbon($request->birthday . '-01 00:00:00');
                $order->weight = $request->weight;
                $order->smoking = $request->smoking ? 1 : 0;
                $order->wechat_id = $request->wechat_id;
                $order->detail = $request->detail;

                $order->save();

                return redirect('orders/');
            }

            public function showPhotos(App\Order $order)
            {
                return view('cms.orders.photos', ['data' => $order]);
            }

            public function storePhotos(Request $request, App\Order $order)
            {
                $this->validate($request, [
                    'photos' => 'required',
                    'photos.*' => 'dimensions:min_width=50,min_height=50' // image|
                ]);

                $photos = [];
                foreach ($request->photos as $photo) {
                    // Save image to storage and get path.
                    if ($photo->isValid()) {
                        $photos[] = $photo->storeAs('images/order/photos/' . Carbon::now()->timestamp, $photo->getClientOriginalName(), 'public');
                    }
                }

                $order->photos = array_merge($order->photos ?: [], $photos);

                $order->save();

                return redirect('orders/' . $order->id);
            }

            public function showConditionReport(App\Order $order)
            {
                return view('cms.orders.condition-report', ['data' => $order]);
            }

            public function storeConditionReport(Request $request, App\Order $order)
            {
                $order->condition_report = $request->condition_report;
                if ($request->send_to_the_doctor_at == null) {
                    $order->send_to_the_doctor_at = null;
                } else if ($order->send_to_the_doctor_at == null) {
                    $order->send_to_the_doctor_at = Carbon::now();
                }

                $order->save();

                return redirect('orders/' . $order->id);
            }

        }
