<?php

namespace App\Http\Controllers\api;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $news_classes = App\News_class::where('type',1)->orderBy('sort')->take(3)->get();

        foreach ($news_classes as $item){

            $news_class = [
                'id' => $item->id,
                'name' => $item->name,
                'type' => $item->type,
                'sort' => $item->sort
            ];

            $news = [];

            foreach ($item->news()->where('published_at','!=' ,null)->orderby('sort')->take(10)->get() as $new){
                $news[] = [
                    'id' => $new->id,
                    'title' => $new->title,
                    'cover_image' => $new->cover_image,
                    'published_at' => $new->published_at->format('Y-m-d'),
                    'sort' =>$new->sort
                ];
            }

            $articles['news_classes'][] = array_merge($news_class,['news'=>$news]);
        }

        $recommends = App\News::where([
            ['published_at','!=' ,null],
            [ 'news_class_id','<=',3 ],
            [ 'is_recommended',1 ]
        ])->orderBy('updated_at','desc')
            ->get();

        foreach ($recommends as $recommend){
            $rec['recommends'][] = [
                'id' => $recommend->id,
                'title' => $recommend->title,
                'banner_image' => $recommend->banner_image,
                'published_at' => $recommend->published_at->format('Y-m-d'),
                'sort' =>$recommend->sort
            ];
        }

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => [
                'news_classes' => $articles['news_classes'],
                'recommends' => $rec['recommends'],
            ]
        ])->toJson();

    }

    public function loadMore(Request $request)
    {
        $count = count(
            App\News::where([
                ['published_at','!=' ,null],
                ['news_class_id', $request->news_class_id]
            ])->get()
        );

        $news = App\News::where([
            ['published_at','!=' ,null],
            ['news_class_id', $request->news_class_id]
        ])->select('id','title','cover_image','published_at','sort')
               ->orderby('sort')
               ->skip($request->skip)
               ->take(10)
               ->get();


        $count = $count-($request->skip+count($news));

       return collect(['status' => 1,
            'msg' => '加载成功',
            'data' => [
                'news' => $news,
               'count' => isset($count) && $count > 0 ? 1 : 0
        ]])->toJson();

    }

    public function show($id)
    {
        $news = App\News::findOrFail($id);

        return view('api.news.show',[
            'news' => $news
        ]);
    }

    public function guide(){

        $news_classes = App\News_class::where('type',2)->orderBy('sort')->take(3)->get();

        foreach ($news_classes as $item){

            $news_class = [
                'id' => $item->id,
                'name' => $item->name,
                'type' => $item->type,
                'sort' => $item->sort
            ];

            $news = [];

            foreach ($item->news()->where('published_at','!=' ,null)->orderby('sort')->take(10)->get() as $new){
                $news[] = [
                    'id' => $new->id,
                    'title' => $new->title,
                    'cover_image' => $new->cover_image,
                    'published_at' => $new->published_at->format('Y-m-d'),
                    'sort' =>$new->sort
                ];
            }

            $articles['news_classes'][] = array_merge($news_class,['news'=>$news]);
        }

        $recommends = App\News::where([
            ['published_at','!=' ,null],
            [ 'news_class_id','>',3 ],
            [ 'is_recommended_1',1 ]
        ])->orderBy('updated_at','desc')
            ->get();

        foreach ($recommends as $recommend){
            $rec['recommends'][] = [
                'id' => $recommend->id,
                'title' => $recommend->title,
                'banner_image' => $recommend->banner_image,
                'published_at' => $recommend->published_at->format('Y-m-d'),
                'sort' =>$recommend->sort
            ];
        }

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => [
                'news_classes' => $articles['news_classes'],
                'recommends' => $rec['recommends'],
            ]
        ])->toJson();
    }


}
