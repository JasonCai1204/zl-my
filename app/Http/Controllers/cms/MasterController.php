<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('department');
        $this->middleware('master');
    }

    public function create()
    {
        return view('cms.masters.create', ['departments' => App\Department::orderBy('id')->get()]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'm_id' => 'required|unique:masters|digits:6',
            'name' => 'required|max:5',
            'phone_number' => 'required|unique:users|digits:11',
            'department_id' => 'required|exists:departments,id',
            'password' => 'required|min:8'
        ]);

        $master = new App\Master;
        $master->m_id = $request->m_id;
        $master->name = $request->name;
        $master->department_id = $request->department_id;
        $master->save();

        $user = new App\User;
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->password = bcrypt($request->password);
        $user->role_id = App\Master::where('m_id', $request->m_id)->value('id');
        $user->role_type = 'App\Master';
        $user->save();

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
        $user = App\User::where([['role_id',$request->id],['role_type','App\Master']])->first();

        $this->validate($request, [
            'm_id' => 'required|unique:masters,m_id,' . $master->id . '|digits:6',
            'name' => 'required|max:5',
            'phone_number' => 'required|unique:users,phone_number,' . $user->id . '|digits:11',
            'department_id' => 'required|exists:departments,id'
        ]);

        $master->m_id = $request->m_id;
        $master->name = $request->name;
        $master->department_id = $request->department_id;
        $master->save();


        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->save();

        return redirect('masters');
    }

    public function destroy(App\Master $master)
    {
//        dd($master);
        $master->delete();
        // TODO: I don't know...
        // $department->masters()->where('id', $master)->first()->delete();

        App\User::where('role_id',$master->id)->delete();

        return redirect('masters');
    }

    public function resetPassword(App\Master $master)
    {
        return view('cms.masters.password', ['data' => $master]);
    }

    public function updatePassword(Request $request, App\Master $master)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:8',
        ]);

        $user = App\User::where([['role_id',$master->id],['role_type','App\Master']])->first();

        $user->password = bcrypt($request->password);

        $user->save();

        return redirect('masters/' . $master->id);
    }
}
