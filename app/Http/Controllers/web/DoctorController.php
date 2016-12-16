<?php

namespace App\Http\Controllers\web;

use App;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor', ['only' =>['getProfile','getCondition_report']]);

    }

    public function index()
    {
        $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))
            ->select('id','name','grading')
            ->get();

        $doctors = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))
            ->select('id','name','grading','hospital_id')
            ->get();

        $instances = App\Instance::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        return view('web.doctors.index',[
            'doctors' => $doctors,
            'cities' => $cities,
            'hospitals' => $hospitals,
            'instances' => $instances
        ]);

    }

    public function show($id)
    {
        $doctor = App\Doctor::findOrFail($id);

        $hospital_id = $doctor->hospital->id;

        return view('web.doctors.show',[
            'doctor' => $doctor,
            'doctor_id' => $id,
            'hospital_id' => $hospital_id
        ]);

    }

    public function getSelect(Request $request)
    {
        try {
            $city =App\City::find($request->city_id);
        } catch (ModelNotFoundException $e) {

        }

        try {
            $hospital = App\Hospital::find($request->hospital_id);
        } catch (ModelNotFoundException $e) {

        }

        try {
            $instance = App\Instance::find($request->instance_id);
        } catch (ModelNotFoundException $e) {

        }

        $d1 = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))
//            ->where('hospital_id',$request->hospital_id)
            ->get();

//        $doctors[] = [];

        foreach ($d1 as $key=>$value) {
            $doctors[] = $value;
//            $doctors[][]['name'] = $value;

        }



        dd($doctors);



        if (isset($city) && isset($hospital))
        {
            if ($city->id != $hospital->city_id) {
                dd('暂无符合条件的医生');
            } else {
                $d1 = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))
                    ->where('hospital_id',$request->hospital_id)
                    ->get();
            }

        }

        if (isset($hospital) && isset($instance))
        {

            $h_doctors = $hospital->doctors;

            $i_doctors = $instance->doctors;

            if (!$h_doctors->intersect($i_doctors)) {
                dd('暂无符合条件的医生');
            } else {
                $d2 = $h_doctors->intersect($i_doctors);
            }

        }

        if (isset($city) && isset($instance))
        {
            foreach ($city->hospitals as $hospital) {
                foreach ($hospital->doctors as $doctor) {
                    $c_doctors[] = $doctor;
                }
            }

            $i_doctors = $instance->doctors;

            if (count($i_doctors->intersect(collect($c_doctors))) == 0) {
                dd('暂无符合条件的医生');
            } else {
                $d3 = $i_doctors->intersect(collect($c_doctors));
            }

        }

        if (isset($d1) && isset($d2) && isset($d3))
        {
            dd($doctors = $d2);
        }

        if (isset($d1) && isset($d2) && !isset($d3))
        {
            dd($doctors = $d2);
        }

        if (!isset($d1) && isset($d2) && !isset($d3)) {
            dd($doctors = $d2);
        }

        if (isset($d1) && !isset($d2) && !isset($d3)) {
            dd($doctors = $d1);
        }

        if (!isset($d1) && !isset($d2) && isset($d3)) {
            dd($doctors = $d3);
        }

        if (isset($d1) && !isset($d2) && isset($d3)) {

            if (count($d1->intersect($d3)) == 0) {
                dd('暂无符合条件的医生');
            } else {
                $doctors = $d1->intersect($d3);

                dd($doctors);
            }

        }

        if (!isset($d1) && isset($d2) && isset($d3)) {

            if (count($d2->intersect($d3)) == 0) {
                dd('暂无符合条件的医生');
            } else {
                $doctors = $d2->intersect($d3);

                dd($doctors);
            }
        }



        // hospital's doctors.
//        if ($request->has('hospital_id')) {
//            $doctors1 = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))
//                ->where('hospital_id', $request->hospital_id)
//                ->get();
//        }
//
//        // instance's doctors.
//        if ($request->has('instance_id')) {
//            $doctors2 = App\Instance::find($request->instance_id)->doctors;
//        }
//
//        if (isset($doctors1) && isset($doctors2)) {
//            $doctors = $doctors1->intersect($doctors2);
//        }
//
//        if (isset($doctors1) && !isset($doctors2)) {
//            $doctors = $doctors1;
//        }
//
//        if (!isset($doctors1) && isset($doctors2)) {
//            $doctors = $doctors2;
//        }
//
//        if (!isset($doctors1) && !isset($doctors2)) {
//            $doctors = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))
//                ->get();
//        }
//
//        // package
//        $data = [
//            'doctors' => $doctors,
//        ];
//
//        if ($request->has('hospital_id'))
//            $data['hospital_id'] = $request->hospital_id;
//        if ($request->has('doctor_id'))
//            $data['doctor_id'] = $request->doctor_id;
//        if ($request->has('instance_id'))
//            $data['instance_id'] = $request->instance_id;
//
//        return view('web.doctors.select', $data);


    }

    // Doctor profile.
    public function getProfile(Request $request)
    {
        $doctor = App\Doctor::find(Auth::guard('doctor')->user()->id);

        return view('web.doctors.profile',[
            'doctor' => $doctor
        ]);

    }

    // Get condition_report.
    public function getCondition_report(Request $request)
    {
        $order = App\Order::find($request->id);

        return view('web.doctors.report',[
            'order'=> $order
        ]);

    }
}
