<?php

namespace App\Http\Controllers;

use App\Http\Models as app;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = app\News::orderby('published_at','desc')
                ->take(15)
                ->get();

        return view('users.news.news',[
              'news' =>$news
            ]);
    }

    public function loadMore(Request $request)
    {

           $news = app\News::orderby('published_at','desc')
               ->skip(15+($request->counter-1)*10)
               ->take(11)
               ->get();

           return collect([
                'data' => $news
            ])->toJson();

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
        $news = app\News::findOrFail($id);

        return view('users.news.show',[
            'news' => $news
        ]);
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
        return view('cms.news.create');
    }

    public function store4cms(Request $request)
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
    }

    public function index4cms()
    {
        return view('cms.news.index', ['data' => App\News::all()]);
    }

    public function show4cms(App\News $news)
    {
        return view('cms.news.show', ['data' => $news]);
    }

    public function update4cms(Request $request, App\News $news)
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

    public function destroy4cms(App\News $news)
    {
        $news->delete();

        return redirect('news');
    }

}
