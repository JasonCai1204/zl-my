<?php

namespace App\Http\Controllers\api;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = App\Hospital::where('is_recommended', 1)->get();

        $data = [];

        foreach ($hospitals as $hospital) {
            $data['recommended'][] = [
                'id' => $hospital->id,
                'name' => $hospital->name,
                'grading' => $hospital->grading,
                'is_recommended' => $hospital->is_recommended,
                'city_name' => $hospital->city->name
            ];
        }

        $hospitals = App\Hospital::all();

        foreach ($hospitals as $hospital) {
            $data['hospitals'][] = [
                'id' => $hospital->id,
                'name' => $hospital->name,
                'grading' => $hospital->grading,
                'is_recommended' => $hospital->is_recommended,
                'city_name' => $hospital->city->name
            ];
        }

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => [
                'recommended' => $data['recommended'],
                'hospitals' => $data['hospitals']
            ]
        ])->toJson();

    }

    public function detail(Request $request)
    {
        $hospital = App\Hospital::findOrFail($request->hospital_id)->introduction;

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => [
                'introduction' => $hospital
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
            ->select('id', 'name', 'grading', 'is_recommended', 'city_id')
            ->get();

        if (isset($hospitals))
            foreach ($hospitals as $hospital) {
                $data['hospitals'][] = [
                    'id' => $hospital->id,
                    'name' => $hospital->name,
                    'grading' => $hospital->grading,
                    'is_recommended' => $hospital->is_recommended,
                    'city_name' => $hospital->city->name
                ];
            }


        $doctors = App\Doctor::where('name', 'like', '%' . $request->q . '%')
            ->select('id', 'avatar', 'name', 'grading', 'hospital_id', 'is_certified', 'is_recommended')
            ->get();

        if (isset($doctors))
            foreach ($doctors as $doctor) {
                $data['doctors'][] = [
                    'id' => $doctor->id,
                    'avatar' => $doctor->avatar,
                    'name' => $doctor->name,
                    'grading' => $doctor->grading,
                    'hospital_id' => $doctor->hospital_id,
                    'is_certified' => $doctor->is_certified,
                    'is_recommended' => $doctor->is_recommended,
                    'hospital_name' => $doctor->hospital->name,
                ];
            }

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            $data
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