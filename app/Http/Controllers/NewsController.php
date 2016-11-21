<?php

namespace App\Http\Controllers;

use App\Http\Models as app;
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
//        if($request->url() == '/'){
//           $news = app\News::sortby('created_at','desc')
//                             ->take(15)
//                             ->get();
//            return view('index',[
//                'news' =>$news
//            ]);
//        }

        $news = app\News::select('id','title','cover_image')
                ->orderby('created_at','desc')
                ->skip(2)
                ->take(2)
                ->get();

        foreach($news as $new){
            $New[] = $new."url"."=>"."123" ;

        }

//        $News = json_encode($New);

        dd($New);
        return view('news.news',[
              'news' =>$news
            ]);
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

        return view('news.show',[
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

    /**
     * CMS begin
     */
}
