<?php

namespace App\Http\Controllers\cms;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class News_classController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('master');
    }

    public function create()
    {
        $news_classes = App\News_class::orderBy('type')->get();

        return view('cms.news_class.create', [
            'classes' => ['资讯','科普'],
            'news_classes' => $news_classes
        ]);
    }

    public function store(Request $request)
    {
        $news_class = new App\News_class;
        $nameConstraint = 'required|unique:news_classed|max:9';

        $this->validate($request, [
            'name' => $nameConstraint,
            'type_and_sort' => 'required'
        ]);

        $type = explode(',', $request->type_and_sort)[0];
        $sort = explode(',', $request->type_and_sort)[1];
        Validator::make([
            'type_id' => $type,
            'sort' => $sort
        ], [
            'type_id' => 'required|exists:types,id',
            'sort' => 'required|numeric'
        ])->validate();

        $news_class->name = $request->name;


        // Adjust sort.
        App\News_class::where([
            ['type', $type],
            ['sort', '>=', $sort]
        ])->increment('sort');

        $news_class->type = $type;
        $news_class->sort = $sort;

        $news_class->save();

        return redirect('/news_class');

    }

    public function index()
    {
        return view('cms.news_class.index', ['data' => App\News_class::orderBy('type')->orderBy('sort')->get()]);
    }

    public function show(App\News_class $news_class)
    {
        $news_classes = App\News_class::orderBy('type')->get();

        return view('cms.news_class.show', [
            'data' => $news_class,
            'classes' => ['资讯','科普'],
            'news_classes' => $news_classes,
        ]);
    }

    public function update(Request $request, App\News_class $news_class)
    {
//        dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:types,name,' . $news_class->id . '|max:9',
            'type_and_sort' => 'required'
        ]);

        $news_class->name = $request->name;

        $type = explode(',', $request->type_and_sort)[0];
        $sort = explode(',', $request->type_and_sort)[1];
        Validator::make([
            'type' => $type,
            'sort' => $sort
        ], [
            'type' => 'required|numeric',
            'sort' => 'required|numeric'
        ])->validate();


        // Adjust sort.

        if ($news_class->type == $type ) {
            if ($news_class->sort > $sort) {

                App\News_class::where([
                    ['type', $type],
                    ['sort', '>=', $sort],
                    ['sort', '<', $news_class->sort]
                ])->increment('sort');
            }
            if ($news_class->sort < $sort) {

                App\News_class::where([
                    ['type', $type],
                    ['sort', '<=', $sort],
                    ['sort', '>', $news_class->sort]
                ])->decrement('sort');
            }
        }


        if ($news_class->type != $type){
                App\News_class::where([
                    ['type', $news_class->type],
                    ['sort', '>', $news_class->sort]
                ])->decrement('sort');

                App\News_class::where([
                    ['type', $type],
                    ['sort', '>=', $sort],
                ])->increment('sort');
        }

        $news_class->type = $type;
        $news_class->sort = $sort;

        $news_class->save();

        return redirect('/news_class');
    }

    public function destroy(App\News_class $news_class)
    {
        $news_class->delete();

        // TODO: unset it's instances.

        App\News_class::where([['type', $news_class->type],['sort', '>', $news_class->sort]])->decrement('sort');

        return redirect('/news_class');
    }


}
