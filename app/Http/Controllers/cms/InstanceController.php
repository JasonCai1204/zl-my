<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Models as App;
use Illuminate\Http\Request;
use Validator;

class InstanceController extends Controller
{
    public function create()
    {
        return view('cms.instances.create', ['types' => App\Type::orderBy('sort')->get()]);
    }

    public function store(Request $request)
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

    public function index()
    {
        return view('cms.instances.index', ['data' => App\Instance::orderBy('type_id')->orderBy('sort')->get()]);
    }

    public function show(App\Instance $instance)
    {
        return view('cms.instances.show', [
            'data' => $instance,
            'types' => App\Type::orderBy('sort')->get()
        ]);
    }

    public function update(Request $request, App\Instance $instance)
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

    public function destroy(App\Instance $instance)
    {
        // Adjust sort.
        App\Instance::where([
            ['type_id', $instance->id],
            ['sort', '>', $instance->sort]
        ])->decrement('sort');

        $instance->delete();

        return redirect('instances');
    }
}
