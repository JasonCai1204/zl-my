<?php

namespace App\Http\Controllers;

use App\Http\Models\Hospital;
use App\Http\Models as App;
use Illuminate\Http\Request;

class OrderController extends Controller
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

    //redirect order/create
    public function getCreate(Request $request){

//        if($hospital_id = $request->hospital_id && $doctor_id = $request->doctor_id && $instance_id=$request->instance_id){
//
//            $hospitals = App\Hospital::where('id', $hospital_id)
//                ->get();
//
//            $doctors = App\Doctor::where('id',$doctor_id)
//                    ->get();
//
//            $instances = App\Instance::where('id',$instance_id)
//                    ->get();
//
//            return view('orders.create', [
//                'hospitals' => $hospitals,
//                'doctors' => $doctors,
//                'instances' => $instances
//            ]);
//        }
//
        if($hospital_id = $request->hospital_id && $doctor_id = $request->doctor_id){
            $hospitals = App\Hospital::where('id', $hospital_id)
                ->get();

            $doctors = App\Doctor::where('id', $doctor_id)
                ->get();

            $instances = $doctors->first()->instances;

            return view('orders.create', [
                'hospitals' => $hospitals,
                'doctors' => $doctors,
                'instances' => $instances
            ]);
        }
//
        if($hospital_id = $request->hospital_id ) {
            $hospitals = App\Hospital::where('id', $hospital_id)
                ->get();

//            $doctors = App\Doctor::where('hospital_id', $hospital_id)
//                ->get();

            return view('orders.create', [
                'hospitals' => $hospitals,
                'doctors' => "",
            ]);
        }


//        dd($request->all());
        return view('orders.create');
    }

    //
    public function postCreate(Request $request){


//        if($hopital_id = $request->hospital_id) {
//            $hospitals = App\Hospital::where('id', $hopital_id)
//                ->get();
//
//            $doctors = App\Doctor::where('hospital_id', $hopital_id)
//                ->get();
//
//            return view('orders.create', [
//                'hospitals' => $hospitals,
//                'doctors' => $doctors
//            ]);
//        }
//
//        if($doctor_id = $request->doctor_id){
//
//            dd($request->all());
//
//            $doctors = App\Doctor::where('id', $doctor_id)
//                        ->get();
//
//            $doctor = $doctors->first();
//
//            $hopital_id = $doctor->hospital_id;
//
//            $hospitals = App\Hospital::where('id',$hopital_id)->get();
//
//            $instances = $doctor->instances;
//
//            return view('orders.create', [
//                'hospitals' => $hospitals,
//                'doctors' => $doctors,
//                'instances' => $instances
//            ]);
//        };
//
//        if($instance_id = $request->instance_id){
//            $instances = App\Instance::findOrFail($instance_id);
//
////            $doctors = $instances->doctors-;
//            dd($doctors);
//        }


//            $instances[] = '';
//
//            foreach( $doctors as $index => $doctor){
//                $instances[] = $doctor->instances;
//            }
//
//            dd($instances);


    }

    /**
     * CMS begin
     */
}
