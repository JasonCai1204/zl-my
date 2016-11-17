<?php

namespace App\Http\Controllers;

use App\Http\Models as App;
use App\Http\Models\Instance;
use Illuminate\Http\Request;

class InstanceController extends Controller
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

    //

    //Select instance
    public function getSelect(){
        $instances = App\Instance::all();

        return view('instances.select',[
            'instances' => $instances
        ]);
    }

    //Select instance from doctor
    public function getDoctorSelect(Request $request){

        $doctor_id = $request->doctor_id;

        $doctor = App\Doctor::find($doctor_id);

        $doctorInstances = $doctor->instances;

        return view('instances.select',[
            'hospital_id' => $request->hospital_id,
            'doctor_id' => $doctor_id,
            'doctorInstances' => $doctorInstances
        ]);
    }

    /**
     * CMS begin
     */
}
