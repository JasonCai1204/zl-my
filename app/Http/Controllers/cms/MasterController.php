<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:master');
        $this->middleware('master');
    }

    public function create()
    {
        return view('cms.masters.create', ['departments' => App\Department::orderBy('id')->get()]);
    }

    public function store(Request $request)
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

    public function index()
    {
        return view('cms.masters.index', ['data' => App\Master::orderBy('department_id')->orderBy('id')->get()]);
    }

    public function show(App\Master $master)
    {
        return view('cms.masters.show', [
            'data' => $master,
            'departments' => App\Department::orderBy('id')->get()
        ]);
    }

    public function update(Request $request, App\Master $master)
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

    public function destroy(App\Master $master)
    {
        $master->delete();
        // TODO: I don't know...
        // $department->masters()->where('id', $master)->first()->delete();

        return redirect('masters');
    }

    public function resetPassword(App\Master $master)
    {
        return view('cms.masters.password', ['data' => $master]);
    }

    public function updatePassword(Request $request, App\Master $master)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6'
        ]);

        $master->password = bcrypt($request->password);

        $master->save();

        return redirect('masters/' . $master->id);
    }
}
