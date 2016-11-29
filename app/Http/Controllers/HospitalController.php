<?php

namespace App\Http\Controllers;

use App\Http\Models as App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

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

        return view('users.hospitals.index',[
            'recommendHospitals' => $recommendHospitals,
            'hospitals' => $hospitals
        ]);

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

        return view('users.hospitals.show',[
            'hospital' => $hospital,
            'hospital_id' => $id,
        ]);
    }

    // Search hospitals and doctors
    public function search(Request $request)
    {
        // When search has not  keyword "q".
        if (!$request->has('q')) {
            return view('users.search',[
                'hospitals' => "",
                'doctors' => ""
            ]);
        }

        // Search hospital or doctor.
        $hospitals = App\Hospital::where('name', 'like', '%' . $request->q . '%')
        ->get();

        $doctors = App\Doctor::where('name', 'like', '%' . $request->q . '%')
        ->get();

        return view('users.search', [
            'hospitals' => $hospitals,
            'doctors' => $doctors,
            'q' => $request->q
        ]);
    }

    // Display hospitals
    public function getSelect()
    {
        $recommendHospitals = App\Hospital::where('is_recommended','1')
        ->get();

        $hospitals = App\Hospital::all();

        return view('users.hospitals.select',[
            'recommendHospitals' => $recommendHospitals,
            'hospitals' => $hospitals,
        ]);
    }

}
