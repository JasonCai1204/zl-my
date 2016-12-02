<?php

namespace App\Http\Controllers\api;

use App as App;
use App\Http\Controllers\Controller;
use App\Http\Models\Instance;
use Illuminate\Http\Request;

class InstanceController extends Controller
{
    //Select instance.
    public function getSelect(Request $request)
    {
       if($request->hospital_id < 0 && $request->doctor_id < 0){
           $instances = App\Instance::select('id','name')->get();

           return collect([
               'status' => 1,
               'msg' => '加载成功',
               'data' => $instances
           ])->toJson();

       }elseif($request->doctor_id > 0){
           $doctor = App\Doctor::find($request->doctor_id);

           $instances = $doctor->instances;

           return collect([
               'status' => 1,
               'msg' => '加载成功',
               'data' => $instances
           ])->toJson();
       }else{
           $hospital = App\Hospital::find($request->hospital_id);

            $doctors = $hospital->doctors;

           foreach($doctors as $doctor){
               $instances[] =$doctor->instances->toArray();
           }

           $a = array_collapse($instances);
            $b = array_pluck($a,['name']);
           $c = array_unique($b);

           return collect([
               'status' => 1,
               'msg' => '加载成功',
               'data' => [
                   'name' => $c
               ]
           ])->toJson();

       }





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
