<?php

namespace App\Http\Controllers\web;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{

    public function index()
    {
        $news_class_ids = App\News_class::where('type',1)->orderBy('sort')->take(3)->pluck('id');

        $news = [];

        $count = [];

        foreach ($news_class_ids as $id) {
            $count[] = App\News::where([
                ['published_at','!=' ,null],
                ['news_class_id', $id]
            ])->get();
        }


        foreach ($news_class_ids as $id) {
            $news[] = App\News::where([
                ['published_at','!=' ,null],
                ['news_class_id', $id]
                ])->orderby('sort')
                    ->take(10)
                    ->get();
        }

        $is_recommended = App\News::where([
            ['published_at','!=' ,null],
            [ 'news_class_id','<=',3 ],
            [ 'is_recommended_1',1 ]
        ])->orderBy('updated_at','desc')
            ->get();

        return view('web.news.news',[
              'news' => $news,
              'count' => $count,
              'is_recommended' => $is_recommended
            ]);
    }

    public function loadMore(Request $request)
    {
        $count = count(
            App\News::where([
                ['published_at','!=' ,null],
                ['news_class_id', $request->data]
            ])->get()
        );

        $news = App\News::where([
            ['published_at','!=' ,null],
            ['news_class_id', $request->data]
        ])->orderby('sort')
               ->skip($request->skip)
               ->take(10)
               ->get();

        foreach ($news as $index => $item) {
            $item->date = $item->published_at->format('Y-m-d');
            $news->put($index, $item);
        }

        $count = $count-($request->skip+count($news));

       return collect([
            'data' => $news,
            'count' => isset($count) && $count > 0 ? true : false
        ])->toJson();

    }

    public function show($id)
    {
        $news = App\News::findOrFail($id);

        return view('web.news.show',[
            'news' => $news
        ]);
    }

    public function guide(){
        $news_class_ids = App\News_class::where('type',2)->orderBy('sort')->take(3)->pluck('id');

        $news = [];

        $count = [];

        foreach ($news_class_ids as $id) {
            $count[] = App\News::where([
                ['published_at','!=' ,null],
                ['news_class_id', $id]
            ])->get();
        }


        foreach ($news_class_ids as $id) {
            $news[] = App\News::where([
                ['published_at','!=' ,null],
                ['news_class_id', $id]
            ])->orderby('sort')
                ->take(10)
                ->get();
        }

        $is_recommended = App\News::where([
            [ 'news_class_id','>',3 ],
            [ 'is_recommended_1',1 ]
        ])->orderBy('updated_at','desc')
            ->get();

        return view('web.news.guide',[
            'news' => $news,
            'count' => $count,
            'is_recommended' => $is_recommended
        ]);
    }



}
