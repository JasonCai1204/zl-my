<?php

namespace App\Http\Controllers\api;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news = App\News::select('id', 'title', 'cover_image', 'published_at')
            ->orderby('published_at', 'desc')
            ->skip($request->skip)
            ->take($request->count ? $request->count + 1 : '11')
            ->get();

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => $news
        ])->toJson();

    }

    public function show($id)
    {
        $news = App\News::findOrFail($id);

        return view('api.news.show', [
            'news' => $news
        ]);

    }

}
