<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Models as App;
use DB;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function create()
    {
        return view('cms.hospitals.create', ['cities' => App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get()]);
    }

    public function store(Request $request)
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

    public function index()
    {
        return view('cms.hospitals.index', ['data' => App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get()]);
    }

    public function show(App\Hospital $hospital)
    {
        return view('cms.hospitals.show', [
            'data' => $hospital,
            'cities' => App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get()
        ]);
    }

    public function update(Request $request, App\Hospital $hospital)
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

    public function destroy(App\Hospital $hospital)
    {
        $hospital->delete();

        return redirect('/hospitals');
    }
}
