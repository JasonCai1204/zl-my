<?php

namespace App\Http\Controllers;

use App\Http\Models as App;
use Hash;
use Validator;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $recommendDoctors = App\Doctor::where('is_recommended','1')
        ->get();

        $doctors = App\Doctor::all();

        return view('users.doctors.index',[
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

        return view('users.doctors.show',[
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
    public function getSelect()
    {

        $recommendDoctors = App\Doctor::where('is_recommended','1')
        ->get();

        $doctors = App\Doctor::all();


        return view('users.doctors.select',[
            'recommendDoctors' => $recommendDoctors,
            'doctors' => $doctors
        ]);
    }


    //    //Select doctor from hospital
    public function getHospitalSelect(Request $request)
    {

        $hospitalDoctors = App\Doctor::where('hospital_id',$request->hospital_id)
        ->get();

        return view('users.doctors.select',[
            'hospitalDoctors' => $hospitalDoctors,
            'hospital_id' => $request->hospital_id
        ]);
    }

    // Select doctor from instance
    public function getInstanceSelect(Request $request)
    {
        $instance_id = $request->instance_id;

        $instance = App\Instance::where('id',$instance_id)
        ->get();

        $instanceDoctors = $instance->first()
        ->doctors;

        $instanceDoctor_id = $instanceDoctors
        ->first()->id;

        return view('users.doctors.select',[
            'instance_id' => $instance_id,
            'instanceDoctors'=> $instanceDoctors,
            'instanceDoctor_id' => $instanceDoctor_id
        ]);
    }



}
