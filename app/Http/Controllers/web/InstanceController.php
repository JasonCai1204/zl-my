<?php

namespace App\Http\Controllers\web;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstanceController extends Controller
{
    //Select instance.
    public function getSelect()
    {
        $instances = App\Instance::all();

        return view('web.instances.select',[
            'instances' => $instances
        ]);
    }

    //Select instance from doctor.
    public function getDoctorSelect(Request $request){

        $doctor_id = $request->doctor_id;

        $doctor = App\Doctor::find($doctor_id);

        $doctorInstances = $doctor->instances;

        return view('web.instances.select',[
            'hospital_id' => $request->hospital_id,
            'doctor_id' => $doctor_id,
            'doctorInstances' => $doctorInstances
        ]);
    }

}
