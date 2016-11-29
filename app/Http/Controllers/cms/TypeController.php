<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Models as App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TypeController extends Controller
{
    public function create()
    {
        return view('cms.types.create', ['sort' => count(App\Type::all()) + 1]);
    }

    public function store(Request $request)
    {
        $type = new App\Type;
        $nameConstraint = 'required|unique:types|max:9';

        // if the type has exist and been deleted.
        if ($request->name != null && App\Type::onlyTrashed()->where('name', $request->name)->first() != null) {
            $type = App\Type::onlyTrashed()->where('name', $request->name)->first();
            $nameConstraint = 'required|unique:types,name,' . $type->id . '|max:9';
        }

        $this->validate($request, [
            'name' => $nameConstraint,
            'icon' => 'image|dimensions:min_width=100,min_height=100',
            'sort' => 'required|numeric'
        ]);

        $type->name = $request->name;
        // Save image to storage and get path.
        if ($request->hasFile('icon') && $request->icon->isValid()) {
            $type->icon = $request->icon->storeAs('images/type/icon' . Carbon::now()->timestamp, $request->icon->getClientOriginalName(), 'public');
        }
        // Adjust sort.
        App\Type::where('sort', '>=', $request->sort)->increment('sort');
        $type->sort = $request->sort;
        $type->deleted_at = null;

        $type->save();

        return redirect('/types');
    }

    public function index()
    {
        return view('cms.types.index', ['data' => App\Type::orderBy('sort')->get()]);
    }

    public function show(App\Type $type)
    {
        return view('cms.types.show', ['data' => $type, 'sort' => count(App\Type::all())]);
    }

    public function update(Request $request, App\Type $type)
    {
        $this->validate($request, [
            'name' => 'required|unique:types,name,' . $type->id . '|max:9',
            'icon' => 'image|dimensions:min_width=100,min_height=100',
            'sort' => 'required|numeric'
        ]);

        $type->name = $request->name;
        // Save image to storage and get path.
        if ($request->hasFile('icon') && $request->icon->isValid()) {
            $type->icon = $request->icon->storeAs('images/type/icon/' . Carbon::now()->timestamp, $request->icon->getClientOriginalName(), 'public');
        }
        // Adjust sort.
        if ($type->sort > $request->sort) {
            App\Type::where([
                ['sort', '>=', $request->sort],
                ['sort', '<', $type->sort]
                ])->increment('sort');
            }
            if ($type->sort < $request->sort) {
                App\Type::where([
                    ['sort', '<=', $request->sort],
                    ['sort', '>', $type->sort]
                    ])->decrement('sort');
                }
                $type->sort = $request->sort;

                $type->save();

                return redirect('/types');
            }

            public function destroy(App\Type $type)
            {
                $type->delete();

                // TODO: unset it's instances.

                App\Type::where('sort', '>', $type->sort)->decrement('sort');

                return redirect('/types');
            }
        }
