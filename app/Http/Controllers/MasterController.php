<?php

namespace App\Http\Controllers;

use App\Http\Models as App;
use Illuminate\Http\Request;

class MasterController extends Controller
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
    public function create4cms()
    {
        return view('cms.masters.create', ['departments' => App\Department::orderBy('id')->get()]);
    }

    public function store4cms(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|unique:masters|digits:6',
            'name' => 'required|max:5',
            'phone_number' => 'required|unique:masters|digits:11',
            'department_id' => 'required|exists:departments,id',
            'password' => 'required|min:6'
        ]);

        $master = new App\Master;

        $master->id = $request->id;
        $master->name = $request->name;
        $master->phone_number = $request->phone_number;
        $master->department_id = $request->department_id;
        $master->password = bcrypt($request->password);

        $master->save();

        return redirect('masters');
    }

    public function index4cms()
    {
        return view('cms.masters.index', ['data' => App\Master::orderBy('department_id')->orderBy('id')->get()]);
    }

    public function show4cms(App\Master $master)
    {
        return view('cms.masters.show', [
            'data' => $master,
            'departments' => App\Department::orderBy('id')->get()
        ]);
    }

    public function update4cms(Request $request, App\Master $master)
    {
        $this->validate($request, [
            'id' => 'required|unique:masters,id,' . $master->id . '|digits:6',
            'name' => 'required|max:5',
            'phone_number' => 'required|unique:masters,phone_number,' . $master->id . '|digits:11',
            'department_id' => 'required|exists:departments,id'
        ]);

        $master->id = $request->id;
        $master->name = $request->name;
        $master->phone_number = $request->phone_number;
        $master->department_id = $request->department_id;

        $master->save();

        return redirect('masters');
    }

    public function destroy4cms(App\Master $master)
    {
        $master->delete();
        // TODO: I don't know...
        // $department->masters()->where('id', $master)->first()->delete();

        return redirect('masters');
    }

    public function resetPassword4cms(App\Master $master)
    {
        return view('cms.masters.password', ['data' => $master]);
    }

    public function updatePassword4cms(Request $request, App\Master $master)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6'
        ]);

        $master->password = bcrypt($request->password);

        $master->save();

        return redirect('masters/' . $master->id);
    }

}
