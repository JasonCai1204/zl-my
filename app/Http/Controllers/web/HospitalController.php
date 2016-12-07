<?php

namespace App\Http\Controllers\web;

use App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recommendHospitals = App\Hospital::where('is_recommended', '1')
            ->orderBy(DB::raw('CONVERT(name USING gbk)'))
            ->get();

        $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        return view('web.hospitals.index', [
            'recommendHospitals' => $recommendHospitals,
            'hospitals' => $hospitals
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hospital = App\Hospital::findOrFail($id);

        $hospital->city = $hospital->city->name;

        return view('web.hospitals.show', [
            'hospital' => $hospital,
            'hospital_id' => $id,
        ]);
    }

    // Search hospitals and doctors
    public function search(Request $request)
    {
        // When search has not  keyword "q".
        if (!$request->has('q')) {
            return view('web.app.search', [
                'hospitals' => "",
                'doctors' => ""
            ]);
        }

        // Search hospital or doctor.
        $hospitals = App\Hospital::where('name', 'like', '%' . $request->q . '%')
            ->orderBy(DB::raw('CONVERT(name USING gbk)'))
            ->get();

        $doctors = App\Doctor::where('name', 'like', '%' . $request->q . '%')
            ->orderBy(DB::raw('CONVERT(name USING gbk)'))
            ->get();

        return view('web.app.search', [
            'hospitals' => $hospitals,
            'doctors' => $doctors,
            'q' => $request->q
        ]);
    }

    // Display hospitals
    public function getSelect(Request $request)
    {

        $recommendHospitals = App\Hospital::where('is_recommended', '1')
            ->orderBy(DB::raw('CONVERT(name USING gbk)'))
            ->get();

        $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        return view('web.hospitals.select', [
            'recommendHospitals' => $recommendHospitals,
            'hospitals' => $hospitals,
            'check_hospital_id' => $request->check_hospital_id ?: '',
            'doctor_id' => $request->doctor_id ?: '',
            'instance_id' => $request->instance_id ?: ''
        ]);
    }

}
