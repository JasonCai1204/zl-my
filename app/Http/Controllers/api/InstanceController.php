<?php

namespace App\Http\Controllers\api;

use App\Http\Models as App;
use App\Http\Controllers\Controller;
use App\Http\Models\Instance;
use Illuminate\Http\Request;

class InstanceController extends Controller
{
    //Select instance.
    public function getSelect()
    {
        $instances = App\Instance::all();

        return view('users.instances.select',[
            'instances' => $instances
        ]);
    }

    //Select instance from doctor.
    public function getDoctorSelect(Request $request){

        $doctor_id = $request->doctor_id;

        $doctor = App\Doctor::find($doctor_id);

        $doctorInstances = $doctor->instances;

        return view('users.instances.select',[
            'hospital_id' => $request->hospital_id,
            'doctor_id' => $doctor_id,
            'doctorInstances' => $doctorInstances
        ]);
    }

}
