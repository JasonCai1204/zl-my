<?php

namespace App\Http\Controllers\cms;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('master');
    }

    public function create()
    {
        return view('cms.departments.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|unique:departments|digits:4',
            'name' => 'required|unique:departments|max:9'
        ]);

        $department = new App\Department;

        $department->id = $request->id;
        $department->name = $request->name;

        $department->save();

        return redirect('departments');
    }

    public function index()
    {
        return view('cms.departments.index', ['data' => App\Department::orderBy('id')->get()]);
    }

    public function show(App\Department $department)
    {
        return view('cms.departments.show', ['data' => $department]);
    }

    public function update(Request $request, App\Department $department)
    {
        $this->validate($request, [
            'id' => 'required|unique:departments,id,'. $department->id . '|digits:4',
            'name' => 'required|unique:departments,name,' . $department->id . '|max:9'
        ]);

        // update it's master's id.
        $department->masters()->update([
            'department_id' => $request->id
        ]);

        $department->id = $request->id;
        $department->name = $request->name;

        $department->save();

        return redirect('departments');
    }

    public function destroy(App\Department $department)
    {
        // TODO: Delete it's all masters.
        if (count($department->masters) > 0) {
            return '<h1>请先删除此部门的所有天才，再来删除。</h1>';
        }

        $department->delete();

        return redirect('departments');
    }
}
