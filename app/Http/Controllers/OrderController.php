<?php

namespace App\Http\Controllers;

use App\Http\Models\Hospital;
use App\Http\Models as App;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

            $hospitals = Hospital::where('id',$hospital_id)
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

                $hospitals = Hospital::where('id',$hospital_id)
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

             $path =  $request->file->storeAs('images/orders/photos/' . Carbon::now()->timestamp, $request->file->getClientOriginalName(), 'public');

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
                'patient_name' => 'required|',
                'phone_number' => 'required|digits:11',
            ];

            $messages = [
                'patient_name.required' => '请输入姓名',
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

                $photos = explode(",", $request->photos);

                $order->photos = json_encode($photos);

                $order->save();

                return view('users.orders.message');

            }else{
                return back()->withErrors($validator);
            }

        }

    }

    // CMS
    public function index4cms()
    {
        return view('cms.orders.index', ['data' => App\Order::all()]);
    }

    public function show4cms(App\Order $order)
    {
        return view('cms.orders.show', [
            'data' => $order,
            'types' => App\Type::orderBy('sort')->get(),
            'hospitals' => App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get()
        ]);
    }

    public function update4cms(Request $request, App\Order $order)
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
        $order->instance_id = $request->instance_id;
        $order->hospital_id = $hospital_id;
        $order->doctor_id = $doctor_id;
        $order->gender = $request->gender;
        $order->birthday = $request->birthday;
        $order->weight = $request->weight;
        $order->smoking = $request->smoking ? 1 : 0;
        $order->wechat_id = $request->wechat_id;
        $order->detail = $request->detail;

        $order->save();

        return redirect('orders/' . $order->id);
    }

    public function showPhotos4cms(App\Order $order)
    {
        return view('cms.orders.photos', ['data' => $order]);
    }

    public function storePhotos4cms(Request $request, App\Order $order)
    {
        $this->validate($request, [
            'photos' => 'required',
            'photos.*' => 'image|dimensions:min_width=50,min_height=50'
        ]);

        $photos = [];
        foreach ($request->photos as $photo) {
            // Save image to storage and get path.
            if ($photo->isValid()) {
                $photos[] = $photo->storeAs('images/order/photos/' . Carbon::now()->timestamp, $photo->getClientOriginalName(), 'public');
            }
        }

        $order->photos = array_merge($order->photos, $photos);

        $order->save();

        return redirect('orders/' . $order->id);
    }

    public function showConditionReport4cms(App\Order $order)
    {
        return view('cms.orders.condition-report', ['data' => $order]);
    }

    public function storeConditionReport4cms(Request $request, App\Order $order)
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
