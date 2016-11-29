<?php

namespace App\Http\Controllers;

use App\Http\Models as App;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // CMS
    public function create4cms()
    {
        return view('cms.departments.create');
    }

    public function store4cms(Request $request)
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

    public function index4cms()
    {
        return view('cms.departments.index', ['data' => App\Department::orderBy('id')->get()]);
    }

    public function show4cms(App\Department $department)
    {
        return view('cms.departments.show', ['data' => $department]);
    }

    public function update4cms(Request $request, App\Department $department)
    {
        $this->validate($request, [
            'id' => 'required|unique:departments,id,'. $department->id . '|digits:4',
            'name' => 'required|unique:departments,name,' . $department->id . '|max:9'
        ]);

        $department->id = $request->id;
        $department->name = $request->name;

        $department->save();

        return redirect('departments');
    }

    public function destroy4cms(App\Department $department)
    {
        // TODO: Delete it's all masters.
        if (count($department->masters) > 0) {
            return '<h1>请先删除此部门的所有天才，再来删除。</h1>';
        }

        $department->delete();

        return redirect('departments');
    }
}
