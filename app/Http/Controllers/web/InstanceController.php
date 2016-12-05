<?php

namespace App\Http\Controllers\web;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstanceController extends Controller
{
    //Select instance.
    public function getSelect(Request $request)
    {
        $instances = App\Instance::all();

        return view('web.instances.select',[
            'instances' => $instances,
            'check_instance_id' => $request->check_instance_id ? : ''
        ]);
    }

    //Select instance from doctor.
    public function getDoctorSelect(Request $request){

//        dd($request->check_instance_id ? : '');

        $doctor_id = $request->doctor_id;

        $doctor = App\Doctor::find($doctor_id);

        $doctorInstances = $doctor->instances;

        return view('web.instances.select',[
            'hospital_id' => $request->hospital_id,
            'doctor_id' => $doctor_id,
            'doctorInstances' => $doctorInstances,
            'check_instance_id' => $request->check_instance_id ? : ''
        ]);
    }

}
