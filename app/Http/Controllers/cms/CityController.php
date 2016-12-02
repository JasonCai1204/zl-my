<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App;
use DB;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:master');
    }

    public function index()
    {
        return view('cms.cities.index', ['data' => App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get()]);
    }

    public function create()
    {
        return view('cms.cities.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:cities|max:9'
        ]);

        App\City::create(['name' => $request->name]);

        return redirect('/cities');
    }

    public function show(App\City $city)
    {
        return view('cms.cities.show', ['data' => $city]);
    }

    public function update(Request $request, App\City $city)
    {
        $this->validate($request, [
            'name' => 'required|unique:cities,name,' . $city->id . '|max:9'
        ]);

        $city->update(['name' => $request->name]);

        return redirect('/cities');
    }

    public function destroy(App\City $city)
    {
        $city->delete();

        // TODO: Unset it's hospitals.

        return redirect('/cities');
    }
}
