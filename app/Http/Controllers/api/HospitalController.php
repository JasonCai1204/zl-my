<?php

namespace App\Http\Controllers\api;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
{
    public function index(Request $request)
    {

        $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        if ($request->has('city_id')){
            foreach ($hospitals->where('city_id', $request->city_id) as $hospital){
                $data['hospitals'][] = [
                    'id' => $hospital->id,
                    'name' => $hospital->name,
                    'avatar' => count($hospital->avatar) > 0 ? $hospital->avatar :'images/hospital/avatar/default.png',
                    'grading' => $hospital->grading,
                    'city_id' => $hospital->city->id,
                    'city_name' => $hospital->city->name,
                ];
            }

            return collect([
                'status' => 1,
                'msg' => '加载成功',
                'data' => isset($data['hospitals']) && count($data['hospitals']) >0 ? $data : ['hospitals' => $data['hospitals'] = []]
            ]);

        }

        foreach ($hospitals as $hospital) {
            $data['hospitals'][] = [
                'id' => $hospital->id,
                'name' => $hospital->name,
                'avatar' => count($hospital->avatar) > 0 ? $hospital->avatar :'images/hospital/avatar/default.png',
                'grading' => $hospital->grading,
                'city_id' => $hospital->city->id,
                'city_name' => $hospital->city->name,
            ];
        }


        $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        foreach ($cities as $city){
            $data['cities'][] =[
                'id' => $city->id,
                'name' => $city->name
            ];
        }


        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => $data
        ])->toJson();

    }

    public function detail(Request $request)
    {
        $hospital = App\Hospital::findOrFail($request->hospital_id);

        foreach ($hospital->doctors()->orderBy(DB::raw('CONVERT(name USING gbk)'))->get() as $doctor ) {
            $info1 = [
                'id' => $doctor->id,
                'avatar' => count($doctor->avatar) > 0 ? $doctor->avatar :'images/doctor/avatar/default.png',
                'name' => $doctor->name,
                'grading' => $doctor->grading,
                'hospital_id' => $doctor->hospital_id,
                'is_certified' => $doctor->is_certified,
            ];


            $instances = [];

                foreach ($doctor->instances as $instance){
                    $instances[] =[
                        'id' => $instance->id,
                        'name' => $instance->name
                    ] ;

                }

            $doctors['doctors'][] = array_merge($info1, ['instances' => $instances]);
        }


        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => [
                'doctors' => $doctors['doctors'],
                'introduction' => $hospital->introduction
            ]
        ])->toJson();
    }

    // Search hospitals and doctors
    public function search(Request $request)
    {
        // When search has not  keyword "q".
        if (!$request->has('q')) {
            return collect([
                'status' => 1,
                'msg' => '加载成功',
                'data' => []
            ]);
        }

        $data = [];

        // Search hospital or doctor.
        $hospitals = App\Hospital::where('name', 'like', '%' . $request->q . '%')
            ->select('id', 'avatar','name', 'grading', 'is_recommended', 'city_id')
            ->get();

        if (isset($hospitals) && count($hospitals)>0) {
            foreach ($hospitals as $hospital) {
                $data['hospitals'][] = [
                    'id' => $hospital->id,
                    'avatar' => count($hospital->avatar) > 0 ? $hospital->avatar : 'images/hospital/avatar/default.png',
                    'name' => $hospital->name,
                    'grading' => $hospital->grading,
                    'city_name' => $hospital->city->name
                ];
            }
        }else {
            $data['hospitals'] = [];
        }


        $doctors = App\Doctor::where('name', 'like', '%' . $request->q . '%')
            ->select('id', 'avatar', 'name', 'grading', 'hospital_id', 'is_certified', 'is_recommended')
            ->get();

        if (isset($doctors) && count($doctors)>0){

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
        } else{
            $data['doctors'] = [];
        }


        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => $data
        ])->toJson();

    }

    // Display hospitals
    public function getSelect()
    {
        $recommendHospitals = App\Hospital::where('is_recommended', '1')
            ->get();

        $hospitals = App\Hospital::all();

        return view('users.hospitals.select', [
            'recommendHospitals' => $recommendHospitals,
            'hospitals' => $hospitals,
        ]);
    }


}