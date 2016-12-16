<?php

namespace App\Http\Controllers\web;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $news = App\News::where( 'published_at','!=' ,null )
                ->orderby('published_at','desc')
                ->take(15)
                ->get();

        return view('web.news.news',[
              'news' =>$news
            ]);
    }

    public function loadMore(Request $request)
    {
       $news = App\News::where( 'published_at','!=' ,null )
               ->orderby('published_at','desc')
               ->skip(15+($request->counter-1)*10)
               ->take(11)
               ->get();

       return collect([
            'data' => $news
        ])->toJson();
    }

    public function show($id)
    {
        $news = App\News::findOrFail($id);

        return view('web.news.show',[
            'news' => $news
        ]);
    }

}
