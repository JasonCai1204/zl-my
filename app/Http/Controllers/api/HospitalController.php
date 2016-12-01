<?php

namespace App\Http\Controllers\api;

use App as App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class HospitalController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $hospitals = App\Hospital::where('is_recommended',1)->get();

        $data = [];

        foreach($hospitals as $hospital){
            $data['recommended'][] = [
                'id' => $hospital->id,
                'name' => $hospital->name,
                'grading' => $hospital->grading,
                'is_recommended' => $hospital->is_recommended,
                'city_name' => $hospital->city->name
            ];
        }

        $hospitals = App\Hospital::all();

        foreach($hospitals as $hospital){
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

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function detail(Request $request)
    {
        $hospital = App\Hospital::findOrFail($request->hospital_id)->introduction;
        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' =>[
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
                'meg' => '加载成功',
                'data'=>['']
            ]);
        }

        // Search hospital or doctor.
        $hospitals = App\Hospital::where('name', 'like', '%' . $request->q . '%')
        ->get();

        $doctors = App\Doctor::where('name', 'like', '%' . $request->q . '%')
        ->get();

        return view('users.search', [
            'hospitals' => $hospitals,
            'doctors' => $doctors,
            'q' => $request->q
        ]);
    }

    // Display hospitals
    public function getSelect()
    {
        $recommendHospitals = App\Hospital::where('is_recommended','1')
        ->get();

        $hospitals = App\Hospital::all();

        return view('users.hospitals.select',[
            'recommendHospitals' => $recommendHospitals,
            'hospitals' => $hospitals,
        ]);
    }

}
