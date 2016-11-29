<?php

namespace App\Http\Controllers;

use App\Http\Models as App;
use DB;
use Illuminate\Http\Request;

class CityController extends Controller
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

    // CMS

    public function index4cms()
    {
        return view('cms.cities.index', ['data' => App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get()]);
    }

    public function create4cms()
    {
        return view('cms.cities.create');
    }

    public function store4cms(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:cities|max:9'
        ]);

        App\City::create(['name' => $request->name]);

        return redirect('/cities');
    }

    public function show4cms(App\City $city)
    {
        return view('cms.cities.show', ['data' => $city]);
    }

    public function update4cms(Request $request, App\City $city)
    {
        $this->validate($request, [
            'name' => 'required|unique:cities,name,' . $city->id . '|max:9'
        ]);

        $city->update(['name' => $request->name]);

        return redirect('/cities');
    }

    public function destroy4cms(App\City $city)
    {
        $city->delete();

        // TODO: Unset it's hospitals.

        return redirect('/cities');
    }

}
