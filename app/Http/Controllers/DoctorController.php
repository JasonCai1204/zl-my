<?php

namespace App\Http\Controllers;

use App\Http\Models as App;
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

        return view('doctors.doctor',[
            'recommendDoctors' => $recommendDoctors,
            'doctors' => $doctors
        ]);
    }

    /**
     * CMS Start
     */

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

        return view('doctors.show',[
           'doctor' => $doctor
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


    /**
     * CMS End
     */

    //signIn
    public function getLogin(){
        return view('doctors.signin');
    }

    public function postLogin(){

    }

    //Select doctor
    public function getSelect(){
        $recommendDoctors = App\Doctor::where('is_recommended','1')
            ->get();

        $doctors = App\Doctor::all();

        return view('doctors.select',[
            'recommendDoctors' => $recommendDoctors,
            'doctors' => $doctors
        ]);
    }

    public function postSelect(Request $request){
        $doctors = App\Doctor::where('id',$request->id)->get();

        return view('orders/create',[
            'doctors' => $doctors
        ]);
    }

    //Select doctor from hospital
    public function getHospitalSelect(Request $request){
        $hospitalDoctors = App\Doctor::where('hospital_id',$request->id)->get();

        return view('doctors.select',[
            'recommendDoctors' => "",
            'doctors' => "",
            'hospitalDoctors' => $hospitalDoctors
        ]);
    }

    public function postHospitalSelect(Request $request){
        $hospitals = App\Hospital::where('id',$request->id)
            ->get();

        $doctors = App\Doctor::where('hospital_id',$request->id)
                    ->get();

        return view('orders/create',[
            'hospitals' => $hospitals,
            'doctors' => $doctors,
        ]);
    }


    //getOrders
//    public function getOrders(Request $request){
//
//        $doctors = App\Doctor::where('id','1')
//                ->orders;
//
//        dd($doctors);
//
////        return view('doctors.order',[
////            'orders' => $orders
////        ]);
//    }



}
