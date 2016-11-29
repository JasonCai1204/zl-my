<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models as app;

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

    public function recommend(){

        $hospitals = app\Hospital::all();

        $doctors = app\Doctor::all();

        return view('users.recommend',[
            'hospitals' => $hospitals,
            'doctors' => $doctors,
        ]);

    }


}
