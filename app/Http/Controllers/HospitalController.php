<?php

namespace App\Http\Controllers;

use App\Http\Models as App;
use DB;
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

        return view('users.hospitals.show',[
            'hospital' => $hospital,
            'hospital_id' => $id,
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


    // CMS
    public function create4cms()
    {
        return view('cms.hospitals.create', ['cities' => App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get()]);
    }

    public function store4cms(Request $request)
    {
        $hospital = new App\Hospital;
        $nameConstraint = 'required|unique:hospitals|max:30';

        // if the type has exist and been deleted.
        if ($request->name != null && App\Hospital::onlyTrashed()->where('name', $request->name)->first() != null) {
            $hospital = App\Hospital::onlyTrashed()->where('name', $request->name)->first();
            $nameConstraint = 'required|unique:hospitals,name,'. $hospital->id . '|max:30';
        }

        $this->validate($request, [
            'name' => $nameConstraint,
            'grading' => 'required|max:9',
            'city_id' => 'required|exists:cities,id',
            'introduction' => 'required'
        ]);

        $hospital->name = $request->name;
        $hospital->grading = $request->grading;
        $hospital->city_id = $request->city_id;
        $hospital->introduction = $request->introduction;
        $hospital->is_recommended = isset($request->is_recommended) ? 1 : 0;
        $hospital->deleted_at = null;

        $hospital->save();

        return redirect('/hospitals');
    }

    public function index4cms()
    {
        return view('cms.hospitals.index', ['data' => App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get()]);
    }

    public function show4cms(App\Hospital $hospital)
    {
        return view('cms.hospitals.show', [
            'data' => $hospital,
            'cities' => App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get()
        ]);
    }

    public function update4cms(Request $request, App\Hospital $hospital)
    {
        $this->validate($request, [
            'name' => 'required|unique:hospitals,name,' . $hospital->id . '|max:30',
            'grading' => 'required|max:9',
            'city_id' => 'required|exists:cities,id',
            'introduction' => 'required'
        ]);

        $hospital->name = $request->name;
        $hospital->grading = $request->grading;
        $hospital->city_id = $request->city_id;
        $hospital->introduction = $request->introduction;
        $hospital->is_recommended = isset($request->is_recommended) ? 1 : 0;

        $hospital->save();

        return redirect('/hospitals');
    }

    public function destroy4cms(App\Hospital $hospital)
    {
        $hospital->delete();

        return redirect('/hospitals');
    }


}
