<?php

namespace App\Http\Controllers\web;

use App;
use Hash;
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
        $recommendDoctors = App\Doctor::where('is_recommended','1')
                ->orderBy(DB::raw('CONVERT(name USING gbk)'))
                ->get();

        $doctors = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        return view('web.doctors.index',[
            'recommendDoctors' => $recommendDoctors,
            'doctors' => $doctors
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
        // hospital's doctors.
        if ($request->has('hospital_id')) {
            $rec = App\Doctor::where('is_recommended', '1')
                ->where('hospital_id', $request->hospital_id)
                ->orderBy(DB::raw('CONVERT(name USING gbk)'))
                ->get();
            $all = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))
                ->where('hospital_id', $request->hospital_id)
                ->get();
        }

        // instance's doctors.
        if ($request->has('instance_id')) {
            $rec2 = App\Instance::find($request->instance_id)
                ->doctors()
                ->where('is_recommended', 1)
                ->get();
            $all2 = App\Instance::find($request->instance_id)->doctors;
        }

        if (isset($rec) && isset($rec2)) {
            $rec = $rec->intersect($rec2);
            $all = $all->intersect($all2);
        }
        if (!isset($rec) && isset($rec2)) {
            $rec = $rec2;
            $all = $all2;
        }

        // package
        $data = [
            'rec' => $rec,
            'all' => $all,
        ];
        if ($request->has('hospital_id'))
            $data['hospital_id'] = $request->hospital_id;
        if ($request->has('doctor_id'))
            $data['doctor_id'] = $request->doctor_id;
        if ($request->has('instance_id'))
            $data['instance_id'] = $request->instance_id;

        return view('web.doctors.select', $data);
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
    public function getCondition_report(Request $request){


        $order = App\Order::find($request->id);

        return view('web.doctors.report',[
            'order'=> $order
        ]);
    }

}
