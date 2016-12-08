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
        /*
        1. all $ins1 100
        2. $h > $ins2 15
        3. $d > $ins3 3
        */
        $data = [];

        $ins = App\Instance::all();
        if ($request->has('hospital_id')) {
            $ins = collect([]);
            foreach (App\Hospital::find($request->hospital_id)->doctors as $d) {
                foreach ($d->instances as $i) {
                    $ins->push($i);
                }
            }

            $data['hospital_id'] = $request->hospital_id;
        }
        if ($request->has('doctor_id')) {
            $ins = App\Doctor::find($request->doctor_id)->instances;

            $data['doctor_id'] = $request->doctor_id;
        }

        if ($request->has('instance_id'))
            $data['instance_id'] = $request->instance_id;
        $data['all'] = $ins;

        return view('web.instances.select', $data);
    }

    //Select instance from doctor.
    public function getDoctorSelect(Request $request){

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
