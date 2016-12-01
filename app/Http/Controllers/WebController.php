<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App as app;

class WebController extends Controller
{
    public function index(){

        $news = app\News::orderBy('published_at','desc')
            ->take(3)
            ->get();
        return view('users.index',[
            'news' =>$news
        ]);

    }

    public function recommend()
    {
        $hospitals = app\Hospital::where('is_recommended',1)->get();

        $doctors = app\Doctor::where('is_recommended',1)->get();

        return view('users.recommend',[
            'hospitals' => $hospitals,
            'doctors' => $doctors,
        ]);
    }


}
