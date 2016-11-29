<?php

namespace App\Http\Controllers;

use App\Http\Models as App;
use App\Http\Models\Instance;
use Illuminate\Http\Request;
use Validator;

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


    //Select instance.
    public function getSelect()
    {
        $instances = App\Instance::all();

        return view('users.instances.select',[
            'instances' => $instances
        ]);
    }

    //Select instance from doctor.
    public function getDoctorSelect(Request $request){

        $doctor_id = $request->doctor_id;

        $doctor = App\Doctor::find($doctor_id);

        $doctorInstances = $doctor->instances;

        return view('users.instances.select',[
            'hospital_id' => $request->hospital_id,
            'doctor_id' => $doctor_id,
            'doctorInstances' => $doctorInstances
        ]);
    }

    // CMS
    public function create4cms()
    {
        return view('cms.instances.create', ['types' => App\Type::orderBy('sort')->get()]);
    }

    public function store4cms(Request $request)
    {
        $instance = new App\Instance;
        $nameConstraint = 'required|unique:instances|max:9';

        if ($request->name != null && App\Instance::onlyTrashed()->where('name', $request->name)->first() != null) {
            $instance = App\Instance::onlyTrashed()->where('name', $request->name)->first();
            $nameConstraint = 'required|unique:instances,name,' . $instance->id . '|max:9';
        }

        $this->validate($request, [
            'name' => $nameConstraint,
            'type_id_and_sort' => 'required'
        ]);
        $type_id = explode(',', $request->type_id_and_sort)[0];
        $sort = explode(',', $request->type_id_and_sort)[1];
        Validator::make([
            'type_id' => $type_id,
            'sort' => $sort
        ], [
            'type_id' => 'required|exists:types,id',
            'sort' => 'required|numeric'
        ])->validate();

        // Save data.
        $instance->name = $request->name;
        $instance->type_id = $type_id;
        // Adjust sort.
        App\Type::find($type_id)->instances()->where('sort', '>=', $sort)->increment('sort');
        $instance->sort = $sort;
        $instance->deleted_at = null;

        $instance->save();

        return redirect('instances');
    }

    public function index4cms()
    {
        return view('cms.instances.index', ['data' => App\Instance::orderBy('type_id')->orderBy('sort')->get()]);
    }

    public function show4cms(App\Instance $instance)
    {
        return view('cms.instances.show', [
            'data' => $instance,
            'types' => App\Type::orderBy('sort')->get()
        ]);
    }

    public function update4cms(Request $request, App\Instance $instance)
    {
        $nameConstraint = 'required|unique:instances,name,' . $instance->id . '|max:9';
        if ($request->name != null && App\Instance::onlyTrashed()->where('name', $request->name)->first() != null) {
            App\Instance::where([
                ['type_id', $instance->type_id],
                ['sort', '>', $instance->sort]
            ])->decrement('sort');
            $instance->delete();
            $instance = App\Instance::onlyTrashed()->where('name', $request->name)->first();
            $instance->deleted_at = null;
            $nameConstraint = 'required|unique:instances,name,' . $instance->id . '|max:9';
        }
        $this->validate($request, [
            'name' => $nameConstraint,
            'type_id_and_sort' => 'required'
        ]);
        $type_id = explode(',', $request->type_id_and_sort)[0];
        $sort = explode(',', $request->type_id_and_sort)[1];
        Validator::make([
            'type_id' => $type_id,
            'sort' => $sort
        ], [
            'type_id' => 'required|exists:types,id',
            'sort' => 'required|numeric'
        ])->validate();

        // Save data.
        $instance->name = $request->name;
        // Adjust sort.
        if (App\Instance::onlyTrashed()->where('name', $request->name)->first() == null) {
            App\Instance::where([
                ['type_id', $instance->type_id],
                ['sort', '>', $instance->sort]
            ])->decrement('sort');
        }
        App\Instance::where([
            ['type_id', $type_id],
            ['sort', '>=', $sort],
            ['id', '!=', $instance->id] // ! Add this to avert a conflict.
        ])->increment('sort');
        $instance->type_id = $type_id;
        $instance->sort = $sort;

        $instance->save();

        return redirect('instances');
    }

    public function destroy4cms(App\Instance $instance)
    {
        $instance->delete();

        return redirect('instances');
    }
}
