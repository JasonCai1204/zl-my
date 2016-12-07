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

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
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
        $doctor = App\Doctor::findOrFail($id);

        $hospital_id = $doctor->hospital->id;

        return view('web.doctors.show',[
            'doctor' => $doctor,
            'doctor_id' => $id,
            'hospital_id' => $hospital_id
        ]);
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




    //Select doctor
    public function getSelect(Request $request)
    {

           if($request->has('hospital_id')){

               $hospitalDoctors = App\Doctor::where('hospital_id',$request->hospital_id)
                   ->get();

               return view('web.doctors.select',[
                   'hospitalDoctors' => $hospitalDoctors,
                   'hospital_id' => $request->hospital_id,
                   'check_doctor_id' => $request->check_doctor_id ? : '',
                   'instance_id' => $request->instance_id ? : ''
               ]);

           }elseif($request->has('instance_id')){

               $instance_id = $request->instance_id;

               $instance = App\Instance::where('id',$instance_id)
                   ->get();

               $instanceDoctors = $instance->first()
                   ->doctors;

               $instanceDoctor_id = $instanceDoctors
                   ->first()->id;

               return view('web.doctors.select',[
                   'instance_id' => $instance_id,
                   'instanceDoctors'=> $instanceDoctors,
                   'instanceDoctor_id' => $instanceDoctor_id,
                   'check_doctor_id' => $request->check_doctor_id ? : ''
               ]);

           }


        $recommendDoctors = App\Doctor::where('is_recommended','1')
                ->orderBy(DB::raw('CONVERT(name USING gbk)'))
                ->get();

        $doctors = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();


        return view('web.doctors.select',[
            'recommendDoctors' => $recommendDoctors,
            'doctors' => $doctors,
            'check_doctor_id' => $request->check_doctor_id ? : ''
        ]);
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
