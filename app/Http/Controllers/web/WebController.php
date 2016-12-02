<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function index(){

        $news = App\News::orderBy('published_at','desc')
            ->take(3)
            ->get();
        return view('web.app.index',[
            'news' =>$news
        ]);

    }

    public function recommend()
    {
        $hospitals = App\Hospital::where('is_recommended',1)->get();

        $doctors = App\Doctor::where('is_recommended',1)->get();

        return view('web.app.recommend',[
            'hospitals' => $hospitals,
            'doctors' => $doctors,
        ]);
    }


}
