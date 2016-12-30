<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index()
    {
        $news = App\News::orderBy('published_at', 'desc')->take(3)->get();

        return view('web.app.index', [
            'news' => $news
        ]);
    }

    public function recommend()
    {
        $data = [];

        $hospitals = App\Hospital::where('is_recommended', 1)
            ->orderBy(DB::raw('CONVERT(name USING gbk)'))
            ->get();

        foreach ($hospitals as $hospital) {
            $data['hospitals'][] = [
                'id' => $hospital->id,
                'name' => $hospital->name,
                'grading' => $hospital->grading,
                'introduction' => $hospital->introduction,
                'city' => $hospital->city->name,
            ];
        }

        $doctors = App\Doctor::where('is_recommended', 1)
            ->orderBy(DB::raw('CONVERT(name USING gbk)'))
            ->select('id','name','avatar','grading','introduction','hospital_id')
            ->get();

        foreach ($doctors as $doctor) {
            $data['doctors'][] = [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'avatar' => $doctor->avatar,
                'grading' => $doctor->grading,
                'introduction' => $doctor->introduction,
                'hospital_name' => $doctor->hospital->name,
            ];

        }

        return view('web.app.recommend', $data);
    }

}
