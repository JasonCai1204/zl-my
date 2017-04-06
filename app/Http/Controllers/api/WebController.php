<?php

namespace App\Http\Controllers\api;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index()
    {
        $data = [];

        $news = App\News::where('is_recommended','1')->orderBy('published_at', 'desc')->get();

        foreach ($news as $item) {
            $data['news'][] = [
                'id' => $item->id,
                'title' => $item->title,
                'banner_image' => $item->banner_image,
                'news_class_id' => $item->news_class_id
            ];
        }

        $hospitals = App\Hospital::where('is_recommended', 1)->orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        foreach ($hospitals as $hospital) {
            $data['hospitals'][] = [
                'id' => $hospital->id,
                'name' => $hospital->name,
                'avatar' => count($hospital->avatar) > 0 ? $hospital->avatar :'images/hospital/avatar/default.png',
                'grading' => $hospital->grading,
                'is_recommended' => $hospital->is_recommended,
                'city_id' => $hospital->city->id,
                'city_name' => $hospital->city->name,
            ];
        }

        $doctors = App\Doctor::where('is_recommended', 1)->orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        foreach ($doctors as $doctor) {
            $info1 = [
                'id' => $doctor->id,
                'avatar' => count($doctor->avatar) > 0 ? $doctor->avatar :'images/doctor/avatar/default.png',
                'name' => $doctor->name,
                'grading' => $doctor->grading,
                'hospital_id' => $doctor->hospital_id,
                'is_certified' => $doctor->is_certified,
                'hospital_name' => $doctor->hospital->name,
            ];

            $instances = [];

            foreach ($doctor->instances()->orderBy('sort')->get() as $instance) {
                $instances[] = [
                    'id' => $instance->id,
                    'name' => $instance->name
                ];
            }

            $data['doctors'][] = array_merge($info1, ['instances' => $instances]);
        }

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => [
                'news' => $data['news'],
                'hospitals' => $data['hospitals'],
                'doctors' => $data['doctors']
            ]
        ])->toJson();


    }

    public function recommend(){

        $hospitals = App\Hospital::where('is_recommended', 1)->orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        foreach ($hospitals as $hospital) {
            $data['hospitals'][] = [
                'id' => $hospital->id,
                'name' => $hospital->name,
                'avatar' => count($hospital->avatar) > 0 ? $hospital->avatar :'images/hospital/avatar/default.png',
                'grading' => $hospital->grading,
                'is_recommended' => $hospital->is_recommended,
                'city_id' => $hospital->city->id,
                'city_name' => $hospital->city->name,
            ];
        }

        $doctors = App\Doctor::where('is_recommended', 1)->orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        foreach ($doctors as $doctor) {
            $info1 = [
                'id' => $doctor->id,
                'avatar' => count($doctor->avatar) > 0 ? $doctor->avatar :'images/doctor/avatar/default.png',
                'name' => $doctor->name,
                'grading' => $doctor->grading,
                'hospital_id' => $doctor->hospital_id,
                'is_certified' => $doctor->is_certified,
                'hospital_name' => $doctor->hospital->name,
            ];

            $instances = [];

            foreach ($doctor->instances()->orderBy('sort')->get() as $instance) {
                $instances[] = [
                    'id' => $instance->id,
                    'name' => $instance->name
                ];
            }

            $data['doctors'][] = array_merge($info1, ['instances' => $instances]);
        }

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => [
                'hospitals' => $data['hospitals'],
                'doctors' => $data['doctors']
            ]
        ])->toJson();
    }

    public function checkVersion(Request $request){

        if ($request->client == 'user'){
            if ($request->version < '1'){
                return collect([
                    'status' => 1,
                    'msg' => '肿瘤名医新版已上线，推荐您更新。',
                    'data' => [
                        'url' => 'http://zl-my.com:8000/storage/apps/android/user/com.zl-my_1.0.0_101.apk'
                    ]
                ]);
            }else{
                return collect([
                    'status' => -1,
                    'msg' => '已是最新版本。'
                ]);
            }
        }

        if ($request->client == 'ys'){
            if ($request->version < '1'){
                return collect([
                    'status' => 1,
                    'msg' => '肿瘤名医医生版新版已上线，推荐您更新。',
                    'data' => [
                        'url' => 'http://zl-my.com:8000/storage/apps/android/ys/com.zl-my.ys_1.0.0_101.apk'
                    ]
                ]);
            }else{
                return collect([
                    'status' => -1,
                    'msg' => '已是最新版本。'
                ]);
            }
        }



    }


}
