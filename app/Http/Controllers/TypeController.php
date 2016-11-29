<?php

namespace App\Http\Controllers;

use App\Http\Models as App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TypeController extends Controller
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
        return view('cms.types.create', ['sort' => count(App\Type::all()) + 1]);
    }

    public function store4cms(Request $request)
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
            $type->icon = $request->icon->storeAs('images/type/' . Carbon::now()->timestamp, $request->icon->getClientOriginalName(), 'public');
        }
        // Adjust sort.
        App\Type::where('sort', '>=', $request->sort)->increment('sort');
        $type->sort = $request->sort;
        $type->deleted_at = null;

        $type->save();

        return redirect('/types');
    }

    public function index4cms()
    {
        return view('cms.types.index', ['data' => App\Type::orderBy('sort')->get()]);
    }

    public function show4cms(App\Type $type)
    {
        return view('cms.types.show', ['data' => $type, 'sort' => count(App\Type::all())]);
    }

    public function update4cms(Request $request, App\Type $type)
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

    public function destroy4cms(App\Type $type)
    {
        $type->delete();

        // TODO: unset it's instances.

        App\Type::where('sort', '>', $type->sort)->decrement('sort');

        return redirect('/types');
    }

}
