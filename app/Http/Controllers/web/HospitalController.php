<?php

namespace App\Http\Controllers\web;

use App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        return view('web.hospitals.index', [
            'hospitals' => $hospitals,
            'cities' => $cities
        ]);

    }

    public function show($id)
    {
        $hospital = App\Hospital::findOrFail($id);

        $hospital->city = $hospital->city->name;

        return view('web.hospitals.show', [
            'hospital' => $hospital,
            'hospital_id' => $id,
        ]);
    }

    // Search hospitals and doctors
    public function search(Request $request)
    {
        // When search has not  keyword "q".
        if (!$request->has('q')) {
            return view('web.app.search', [
                'hospitals' => "",
                'doctors' => "",
                'q' => ""
            ]);
        }

        // Search hospital or doctor.
        $hospitals = App\Hospital::where('name', 'like', '%' . $request->q . '%')
            ->orderBy(DB::raw('CONVERT(name USING gbk)'))
            ->get();

        $doctors = App\Doctor::where('name', 'like', '%' . $request->q . '%')
            ->orderBy(DB::raw('CONVERT(name USING gbk)'))
            ->get();

        return view('web.app.search', [
            'hospitals' => $hospitals,
            'doctors' => $doctors,
            'q' => $request->q
        ]);
    }

    // Display hospitals
    public function getSelect(Request $request)
    {
        if ($request->has('city_id'))
        {
            $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))
                ->where('city_id',$request->city_id)
                ->select('id','name','grading','introduction')
                ->get();

            $data['hospitals'] = $hospitals;
        } else {
            $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))
                ->select('id','name','grading','introduction')
                ->get();

            $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['hospitals'] = $hospitals;

            $data['cities'] = $cities;
        }

        if ($request->has('city_id'))
            $data['city_id'] = $request->city_id;
        if ($request->has('hospital_id'))
            $data['hospital_id'] = $request->hospital_id;
        if ($request->has('doctor_id'))
            $data['doctor_id'] = $request->doctor_id;
        if ($request->has('instance_id'))
            $data['instance_id'] = $request->instance_id;


        return view('web.hospitals.select', $data);

    }

    public function getHospitals(Request $request)
    {
        if ($request->has('city_id'))
        {
            $city = App\City::find($request->city_id);

            $hospitals = App\Hospital::where('city_id',$request->ci_id)
                ->select('id','name','grading','city_id')
                ->get();

            return collect ([
                'status' => 1,
                'msg' => '加载成功',
                'data'=>[
                    'city' => $city,
                    'hospitals' => $hospitals
                ]
            ])->toJson();
        }

        $hospitals = App\Hospital::select('id','name','grading','city_id')->get();

        return collect ([
            'status' => 1,
            'msg' => '加载成功',
            'data'=>[
                'hospitals' => $hospitals
            ]
        ])->toJson();

    }


}
