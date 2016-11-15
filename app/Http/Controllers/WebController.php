<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models as app;

class WebController extends Controller
{
    public function index(){

        $news = app\News::orderBy('created_at','desc')
            ->take(3)
            ->get();
        return view('index',[
            'news' =>$news
        ]);

    }

    public function recommend(){

        $hospitals = app\Hospital::all();

        $doctors = app\Doctor::all();

        return view('recommend',[
            'hospitals' => $hospitals,
            'doctors' => $doctors,
        ]);

    }


}
