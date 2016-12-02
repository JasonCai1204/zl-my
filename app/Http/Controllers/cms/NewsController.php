<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:master');
    }

    public function create()
    {
        return view('cms.news.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:64',
            'cover_image' => 'required|image|dimensions:min_width=100,min_height=100',
            'content' => 'required'
        ]);

        $news = new App\News;

        $news->title = $request->title;
        $news->cover_image = $request->cover_image->storeAs('images/news/cover/' . Carbon::now()->timestamp, $request->cover_image->getClientOriginalName(), 'public');
        $news->content = $request->content;
        $news->published_at = $request->published_at ? Carbon::now() : null;

        $news->save();

        return redirect('news');
    }

    public function index()
    {
        return view('cms.news.index', ['data' => App\News::all()]);
    }

    public function show(App\News $news)
    {
        return view('cms.news.show', ['data' => $news]);
    }

    public function update(Request $request, App\News $news)
    {
        $this->validate($request, [
            'title' => 'required|max:64',
            'cover_image' => 'image|dimensions:min_width=100,min_height=100',
            'content' => 'required'
        ]);

        $news->title = $request->title;
        if ($request->hasFile('cover_image') && $request->cover_image->isValid()) {
            $news->cover_image = $request->cover_image->storeAs('images/news/cover/' . Carbon::now()->timestamp, $request->cover_image->getClientOriginalName(), 'public');
        }
        $news->content = $request->content;
        if ($request->has('published_at')) {
            if ($news->published_at == null) {
                $news->published_at = Carbon::now();
            }
        } else {
            $news->published_at = null;
        }

        $news->save();

        return redirect('news');
    }

    public function destroy(App\News $news)
    {
        $news->delete();

        return redirect('news');
    }

}
