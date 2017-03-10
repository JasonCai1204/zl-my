<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:master');
    }

    public function create()
    {
        return view('cms.news.create',['news_classes' => App\News_class::orderBy('type')->orderBy('sort')->get()]);
    }

    public function store(Request $request)
    {
        $news = new App\News;

        $this->validate($request, [
            'title' => 'required|max:64',
            'cover_image' => 'required|dimensions:min_width=140,min_height=140', // image|
            'content' => 'required',
            'news_class_id_and_sort' => 'required'
        ]);


        $news_class_id = explode(',', $request->news_class_id_and_sort)[0];
        $sort = explode(',', $request->news_class_id_and_sort)[1];
        Validator::make([
            'news_class_id' => $news_class_id,
            'sort' => $sort
        ], [
            'news_class_id' => 'required|exists:news_classes,id',
            'sort' => 'required|numeric'
        ])->validate();

        $news->title = $request->title;

        $news->news_class_id = $news_class_id;
        // Adjust sort.

            App\News_class::find($news_class_id)->news()->where('sort', '>=', $sort)->increment('sort');

        $news->sort = $sort;
        $news->deleted_at = null;

        if ($request->hasFile('cover_image') && $request->cover_image->isValid()) {
            $news->cover_image = $request->cover_image->storeAs('images/news/cover/' . Carbon::now()->timestamp, $request->cover_image->getClientOriginalName(), 'public');
        }
        $news->content = $request->get('content');
        $news->published_at = $request->published_at ? Carbon::now() : null;

        if($request->has('is_recommended') && $request->has('is_recommended_1')){
            $this->validate($request, [
                'banner_image' => 'required|dimensions:min_width=320,min_height=150', // image|
            ]);
            if ($request->hasFile('banner_image') && $request->banner_image->isValid()) {
                $news->banner_image = $request->banner_image->storeAs('images/news/banner/' . Carbon::now()->timestamp, $request->banner_image->getClientOriginalName(), 'public');
            }

        }elseif ($request->has('is_recommended')){
            $this->validate($request, [
                'banner_image' => 'required|dimensions:min_width=320,min_height=150', // image|
            ]);
            if ($request->hasFile('banner_image') && $request->banner_image->isValid()) {
                $news->banner_image = $request->banner_image->storeAs('images/news/banner/' . Carbon::now()->timestamp, $request->banner_image->getClientOriginalName(), 'public');
            }
        }elseif ($request->has('is_recommended_1')){
            $this->validate($request, [
                'banner_image' => 'required|dimensions:min_width=320,min_height=150', // image|
            ]);
            if ($request->hasFile('banner_image') && $request->banner_image->isValid()) {
                $news->banner_image = $request->banner_image->storeAs('images/news/banner/' . Carbon::now()->timestamp, $request->banner_image->getClientOriginalName(), 'public');
            }
        }

        $news->is_recommended = $request->is_recommended ? 1 : 0;

        $news->is_recommended_1 = $request->is_recommended_1 ? 1 : 0;

        $news->save();

        return redirect('news');
    }

    public function index()
    {
        return view('cms.news.index', ['data' => App\News::latest()->get()]);
    }

    public function show(App\News $news)
    {
        return view('cms.news.show', [
            'data' => $news,
            'news_classes' => App\News_class::orderBy('type')->orderBy('sort')->get()
        ]);
    }

    public function update(Request $request, App\News $news)
    {


        $this->validate($request, [
            'title' => 'required|max:64',
            'cover_image' => 'dimensions:min_width=140,min_height=140', // image|
            'content' => 'required',
            'news_class_id_and_sort' => 'required'
        ]);

        $news_class_id = explode(',', $request->news_class_id_and_sort)[0];
        $sort = explode(',', $request->news_class_id_and_sort)[1];
        Validator::make([
            'news_class_id' => $news_class_id,
            'sort' => $sort
        ], [
            'news_class_id' => 'required|exists:news_classes,id',
            'sort' => 'required|numeric'
        ])->validate();

        $news->title = $request->title;

        if ($news->sort != null) {
            // Adjust sort.
            if (App\News::onlyTrashed()->where('title', $request->title)->first() == null) {
                App\News::where([
                    ['news_class_id', $news->news_class_id],
                    ['sort', '>', $news->sort]
                ])->decrement('sort');
            }
            App\News::where([
                ['news_class_id', $news_class_id],
                ['sort', '>=', $sort],
                ['id', '!=', $news->id] // ! Add this to avert a conflict.
            ])->increment('sort');
        }

        $news->news_class_id = $news_class_id;
        $news->sort = $sort;

        if ($request->hasFile('cover_image') && $request->cover_image->isValid()) {
            $news->cover_image = $request->cover_image->storeAs('images/news/cover/' . Carbon::now()->timestamp, $request->cover_image->getClientOriginalName(), 'public');
        }
        $news->content = $request->get('content');
        if ($request->has('published_at')) {
            if ($news->published_at == null) {
                $news->published_at = Carbon::now();
            }
        } else {
            $news->published_at = null;
        }

        if($request->has('is_recommended') && $request->has('is_recommended_1')){

            $this->validate($request, [
                'banner_image' => 'dimensions:min_width=320,min_height=150', // image|
            ]);

            if ($request->hasFile('banner_image') && $request->banner_image->isValid()) {
                $news->banner_image = $request->banner_image->storeAs('images/news/banner/' . Carbon::now()->timestamp, $request->banner_image->getClientOriginalName(), 'public');
            }

        }elseif ($request->has('is_recommended')){
            $this->validate($request, [
                'banner_image' => 'dimensions:min_width=320,min_height=150', // image|
            ]);

            if ($request->hasFile('banner_image') && $request->banner_image->isValid()) {
                $news->banner_image = $request->banner_image->storeAs('images/news/banner/' . Carbon::now()->timestamp, $request->banner_image->getClientOriginalName(), 'public');
            }
        }elseif ($request->has('is_recommended_1')){
            $this->validate($request, [
                'banner_image' => 'dimensions:min_width=320,min_height=150', // image|
            ]);

            if ($request->hasFile('banner_image') && $request->banner_image->isValid()) {
                $news->banner_image = $request->banner_image->storeAs('images/news/banner/' . Carbon::now()->timestamp, $request->banner_image->getClientOriginalName(), 'public');
            }
        }

        $news->is_recommended = $request->is_recommended ? 1 : 0;

        $news->is_recommended_1 = $request->is_recommended_1 ? 1 : 0;

        $news->save();

        return redirect('news');
    }

    public function destroy(App\News $news)
    {
        // Adjust sort.
        App\News::where([
            ['news_class_id', $news->id],
            ['sort', '>', $news->sort]
        ])->decrement('sort');

        $news->delete();

        return redirect('news');
    }

}
