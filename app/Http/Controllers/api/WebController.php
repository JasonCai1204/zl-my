<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Models as app;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function index(){

        $news = app\News::orderBy('published_at','desc')
            ->take(3)
            ->get();

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => $news
        ])->toJson();

    }

    public function recommend(){

        $hospitals = app\Hospital::where('is_recommended','1')
                ->get();

        $doctors = app\Doctor::where('is_recommended','1')
            ->get();

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => [
                'hospitals' => $hospitals,
                'doctors' => $doctors
            ]
        ])->toJson();
    }

}
