<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App as app;
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

    public function recommend()
    {
        $hospitals = app\Hospital::where('is_recommended',1)->get();

        $data = [];

        foreach($hospitals as $hospital){
            $data['hospitals'][] = [
                'id' => $hospital->id,
                'name' => $hospital->name,
                'grading' => $hospital->grading,
                'is_recommended' => $hospital->is_recommended,
                'city_name' => $hospital->city->name
            ];
        }

        $doctors = app\Doctor::where('is_recommended',1)->get();

        foreach($doctors as $doctor){
            $data['$doctors'][] = [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'grading' => $doctor->grading,
                'is_recommended' => $doctor->is_recommended,
                'hospital_name' => $doctor->hospital->name
            ];
        }

        return collect([
            'data' => [
                'status' => 1,
                'msg' => '加载成功',
                'hospitals' => $data['hospitals'],
                'doctors' => $data['$doctors']
            ]
        ])->toJson();
    }

}
