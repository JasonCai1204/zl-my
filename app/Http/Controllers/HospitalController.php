<?php

namespace App\Http\Controllers;

use App\Http\Models as App;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recommendHospitals = App\Hospital::where('is_recommended','1')
                             ->get();

        $hospitals = App\Hospital::all();

        return view('hospitals.hospital',[
            'recommendHospitals' => $recommendHospitals,
            'hospitals' => $hospitals
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
        $hospital = App\Hospital::findOrFail($id);

        $hospital->city = $hospital->city->name;

        return view('hospitals.show',[
            'hospital' => $hospital,
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

    //Search hospitals and doctors
    public function search(Request $request)
    {
        // When search has not  keyword "q".

        if (!$request->has('q')) {
            return view('search',[
                'hospitals' => "",
                'doctors' => ""
            ]);
        }

        //Search hospital or doctor.

        $hospitals = App\Hospital::where('name', 'like', '%' . $request->q . '%')->get();

        $doctors = App\Doctor::where('name', 'like', '%' . $request->q . '%')->get();

        return view('search', [
            'hospitals' => $hospitals,
            'doctors' => $doctors,
            'q' => $request->q
        ]);
    }

        //Display hospitals
        public function getSelect()
        {
            $recommendHospitals = App\Hospital::where('is_recommended','1')
                ->get();

            $hospitals = App\Hospital::all();

//            dd('hospitals');

            return view('hospitals.select',[
                'recommendHospitals' => $recommendHospitals,
                'hospitals' => $hospitals,
//                'doctors' => ""
            ]);
        }

        //Select hospital
        public function postSelect(Request $request){

            $hospitals = App\Hospital::where('id',$request->id)
                ->get();

            return view('orders/create',[
                'hospitals' => $hospitals,
                'doctors' => ""
            ]);
        }

}
