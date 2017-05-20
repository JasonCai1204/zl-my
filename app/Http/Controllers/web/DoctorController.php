<?php

namespace App\Http\Controllers\web;

use App;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' =>['getProfile','getCondition_report']]);
        $this->middleware('doctor', ['only' =>['getProfile','getCondition_report']]);
    }


    public function index(Request $request)
    {
        // Try try try...
        try {
            $c = App\City::findOrfail($request->city_id);
        } catch (ModelNotFoundException $e) {
            if ($request->has('city_id')) {
                return view('web.doctors.index',[ 'data' => 0 ]);
            }
        };

        try {
            $h = App\Hospital::findOrfail($request->hospital_id);
        } catch (ModelNotFoundException $e) {
            if ($request->has('hospital_id')) {
                return view('web.doctors.index',[ 'data' => 0 ]);
            }
        };

        try {
            $i = App\Instance::findOrfail($request->instance_id);
        } catch (ModelNotFoundException $e) {
            if ($request->has('instance_id')) {
                return view('web.doctors.index',[ 'data' => 0 ]);
            }
        };


        if (isset($c) || isset($h) || isset($i) )
        {
            // Get doctors via city_id, hospital_id, instance_id.
            $d = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))
                ->select('id','name','grading','hospital_id')
                ->get();

            $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))
                ->select('id','name','grading')
                ->get();

            if (isset($c)) {
                $temp = collect([]);
                foreach ($c->hospitals as $hospital) {
                    $temp = $temp->merge($hospital->doctors);
                }
                $d = $d->intersect($temp);

                $hospitals = $hospitals->intersect($c->hospitals);
            }

            if (isset($h)) {
                $d = $d->intersect($h->doctors);
            }

            if (isset($i)) {
                $d = $d->intersect($i->doctors);
            }

            if (count($d) == 0) {

                return view('web.doctors.index',[
                    'data' => 0 ,
                    'cities' => App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get(),
                    'city_id' => $request->city_id,
                    'hospitals' => App\Hospital::where('city_id',$request->city_id)->orderBy(DB::raw('CONVERT(name USING gbk)'))->select('id','name','grading')->get(),
                    'hospital' => App\Hospital::where('id',$request->hospital_id)->value('name'),
                    'hospital_id' => $request->hospital_id
                ]);
            }


            $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();



            $types = App\Type::orderBy('sort')->get();


            return view('web.doctors.index',[
                'doctors' => $d,
                'cities' => $cities,
                'city_id' => isset($c) ? $request->city_id : '',
                'hospitals' => $hospitals,
                'hospital_id' => isset($h) ? $request->hospital_id : '',
                'types' => $types,
                'type_id' => isset($t) ? $request->type_id : ''
            ]);

        }



        $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

        $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))
            ->select('id','name','grading')
            ->get();

        $doctors = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))
            ->select('id','name','grading','hospital_id')
            ->get();

        $types = App\Type::orderBy('sort')->get();

        return view('web.doctors.index',[
            'doctors' => $doctors,
            'cities' => $cities,
            'hospitals' => $hospitals,
            'types' => $types
        ]);

    }

    public function show($id)
    {
        $doctor = App\Doctor::findOrFail($id);

        $hospital_id = $doctor->hospital->id;

        $avg = (App\Review::where([['status', 1],['doctor_id', $id]])->pluck('ratings'))->avg();

        if ($avg >= 4.5 ) {
            $avg = intval(ceil($avg));
        } else {
            $avg = intval(floor($avg));
        }

        return view('www.doctors.show',[
            'doctor' => $doctor,
            'doctor_id' => $id,
            'hospital_id' => $hospital_id,
            'avg'  => $avg,
            'counts' => count($doctor->reviews()->where('status',1)->get()),
            'reviews' => $doctor->reviews()->where('status',1)->orderBy('created_at','desc')->take(15)->get()
        ]);

    }

    public function getSelect(Request $request)
    {

        try {
            $city =App\City::find($request->city_id);
        } catch (ModelNotFoundException $e) {

        }

        try {
            $hospital = App\Hospital::find($request->hospital_id);
        } catch (ModelNotFoundException $e) {

        }

        try {
            $instance = App\Instance::find($request->instance_id);
        } catch (ModelNotFoundException $e) {

        }

        try {
            $doctor = App\Doctor::find($request->doctor_id);
        } catch (ModelNotFoundException $e) {

        }


        if (isset($city) && isset($hospital))
        {
            if ($city->id != $hospital->city_id) {
                dd('暂无符合条件的医生');
            } else {
                $d1 = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))
                    ->where('hospital_id',$request->hospital_id)
                    ->select('id','avatar','name','grading','hospital_id')
                    ->get();
            }

        }

        if (isset($hospital) && isset($instance))
        {

            $h_doctors = $hospital->doctors;

            $i_doctors = $instance->doctors;

            if (!$h_doctors->intersect($i_doctors)) {
                dd('暂无符合条件的医生');
            } else {
                $d2 = $h_doctors->intersect($i_doctors);
            }

        }

        if (isset($city) && isset($instance))
        {
            foreach ($city->hospitals as $hospital) {
                foreach ($hospital->doctors as $doctor) {
                    $c_doctors[] = $doctor;
                }
            }

            $i_doctors = $instance->doctors;

            if (count($i_doctors->intersect(collect($c_doctors))) == 0) {
                dd('暂无符合条件的医生');
            } else {
                $d3 = $i_doctors->intersect(collect($c_doctors));
            }

        }

        if (!isset($city) && isset($hospital) && !isset($instance)) {
            $d1 = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))
                ->where('hospital_id',$request->hospital_id)
                ->select('id','avatar','name','grading','hospital_id')
                ->get();
        }

        if (!isset($city) && !isset($hospital) && isset($instance)) {

            $doctors = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))
                ->select('id','avatar','name','grading','hospital_id')
                ->get();

            $i_doctors = $instance->doctors;

            $doctors = $doctors->intersect(collect($i_doctors));

            $data = [];

            $data['doctors'] = $doctors;

            if (isset($request->instance_id))
                $data['instance_id'] = $request->instance_id;

            $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['cities'] = $cities;

            $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['hospitals'] = $hospitals;

            $types = App\Type::orderBy('sort')->get();

            $data['types'] = $types;

            return view('web.doctors.select',$data);

        }



        if (!isset($city) && !isset($hospital) && !isset($instance) && isset($doctor)) {

            $doctors = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))
                ->select('id','avatar','name','grading','hospital_id')
                ->get();

            $data = [];

            $data['doctors'] = $doctors;

            if (isset($request->doctor_id))
                $data['doctor_id'] = $request->doctor_id;

            $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['cities'] = $cities;

            $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['hospitals'] = $hospitals;

            $types = App\Type::orderBy('sort')->get();

            $data['types'] = $types;

            return view('web.doctors.select',$data);

        }


        if (isset($d1) && isset($d2) && isset($d3))
        {
            $doctors = $d2;

            $data = [];

            $data['doctors'] = $doctors;

            if($request->has('city_id'))
                $data['city_id'] = $request->city_id;

            if($request->has('hospital_id'))
                $data['hospital_id'] = $request->hospital_id;

            if($request->has('instance_id'))
                $data['instance_id'] = $request->instance_id;

            if($request->has('doctor_id'))
                $data['doctor_id'] = $request->doctor_id;

            $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['cities'] = $cities;

            $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['hospitals'] = $hospitals;

            $types = App\Type::orderBy('sort')->get();

            $data['types'] = $types;

            return view('web.doctors.select',$data);

        }

        if (isset($d1) && isset($d2) && !isset($d3))
        {
            $doctors = $d2;

            $data = [];

            $data['doctors'] = $doctors;

            if($request->has('city_id'))
                $data['city_id'] = $request->city_id;

            if($request->has('hospital_id'))
                $data['hospital_id'] = $request->hospital_id;

            if($request->has('instance_id'))
                $data['instance_id'] = $request->instance_id;

            if($request->has('doctor_id'))
                $data['doctor_id'] = $request->doctor_id;

            $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['cities'] = $cities;

            $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['hospitals'] = $hospitals;

            $types = App\Type::orderBy('sort')->get();

            $data['types'] = $types;

            return view('web.doctors.select',$data);

        }

        if (!isset($d1) && isset($d2) && !isset($d3))
        {
            $doctors = $d2;

            $data = [];

            $data['doctors'] = $doctors;

            if($request->has('city_id'))
                $data['city_id'] = $request->city_id;

            if($request->has('hospital_id'))
                $data['hospital_id'] = $request->hospital_id;

            if($request->has('instance_id'))
                $data['instance_id'] = $request->instance_id;

            if($request->has('doctor_id'))
                $data['doctor_id'] = $request->doctor_id;

            $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['cities'] = $cities;

            $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['hospitals'] = $hospitals;

            $types = App\Type::orderBy('sort')->get();

            $data['types'] = $types;

            return view('web.doctors.select',$data);

        }

        if (isset($d1) && !isset($d2) && !isset($d3))
        {
            $doctors = $d1;

            $data = [];

            $data['doctors'] = $doctors;

            if($request->has('city_id'))
                $data['city_id'] = $request->city_id;

            if($request->has('hospital_id'))
                $data['hospital_id'] = $request->hospital_id;

            if($request->has('instance_id'))
                $data['instance_id'] = $request->instance_id;

            if($request->has('doctor_id'))
                $data['doctor_id'] = $request->doctor_id;

            $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['cities'] = $cities;

            $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['hospitals'] = $hospitals;

            $types = App\Type::orderBy('sort')->get();

            $data['types'] = $types;

            return view('web.doctors.select',$data);

        }

        if (!isset($d1) && !isset($d2) && isset($d3))
        {
            $doctors = $d3;

            $data = [];

            $data['doctors'] = $doctors;

            if($request->has('city_id'))
                $data['city_id'] = $request->city_id;

            if($request->has('hospital_id'))
                $data['hospital_id'] = $request->hospital_id;

            if($request->has('instance_id'))
                $data['instance_id'] = $request->instance_id;

            if($request->has('doctor_id'))
                $data['doctor_id'] = $request->doctor_id;

            $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['cities'] = $cities;

            $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $data['hospitals'] = $hospitals;

            $types = App\Type::orderBy('sort')->get();

            $data['types'] = $types;

            return view('web.doctors.select',$data);

        }

        if (isset($d1) && !isset($d2) && isset($d3)) {

            if (count($d1->intersect($d3)) == 0) {
                dd('暂无符合条件的医生');
            } else {
                $doctors = $d1->intersect($d3);

                $data = [];

                $data['doctors'] = $doctors;

                if($request->has('city_id'))
                    $data['city_id'] = $request->city_id;

                if($request->has('hospital_id'))
                    $data['hospital_id'] = $request->hospital_id;

                if($request->has('instance_id'))
                    $data['instance_id'] = $request->instance_id;

                if($request->has('doctor_id'))
                    $data['doctor_id'] = $request->doctor_id;

                $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

                $data['cities'] = $cities;

                $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

                $data['hospitals'] = $hospitals;

                $types = App\Type::orderBy('sort')->get();

                $data['types'] = $types;

                return view('web.doctors.select',$data);

            }

        }

        if (!isset($d1) && isset($d2) && isset($d3)) {

            if (count($d2->intersect($d3)) == 0) {
                dd('暂无符合条件的医生');
            } else {
                $doctors = $d2->intersect($d3);

                $data = [];

                $data['doctors'] = $doctors;

                if($request->has('city_id'))
                    $data['city_id'] = $request->city_id;

                if($request->has('hospital_id'))
                    $data['hospital_id'] = $request->hospital_id;

                if($request->has('instance_id'))
                    $data['instance_id'] = $request->instance_id;

                if($request->has('doctor_id'))
                    $data['doctor_id'] = $request->doctor_id;

                $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

                $data['cities'] = $cities;

                $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

                $data['hospitals'] = $hospitals;

                $types = App\Type::orderBy('sort')->get();

                $data['types'] = $types;

                return view('web.doctors.select',$data);
            }
        }


        if (!isset($d1) && !isset($d2) && !isset($d3))
        {
            $doctors = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))
                ->select('id','avatar','name','grading','hospital_id')
                ->get();

            $data = [];

            foreach ($doctors as $doctor) {
                $data['doctors'][] = [
                    'id' => $doctor->id,
                    'name' => $doctor->name,
                    'grading' => $doctor->grading,
                    'hospital_id' => $doctor->hospital_id,
                    'hospital_name' => $doctor->hospital->name
                ];
            }

            $cities = App\City::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $hospitals = App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();

            $types = App\Type::orderBy('sort')->get();


            return view('web.doctors.select',[
                'doctors' => $doctors,
                'cities' => $cities,
                'hospitals' => $hospitals,
                'types' => $types
            ]);
        }

    }

    protected function noData()
    {
        return collect([
            'status' => 3,
            'msg' => '加载成功',
            'data' => '暂无符合条件的医生。'
        ])->toJson();
    }


    public function getdoctors(Request $request)
    {
        // Try try try...
        try {
            $c = App\City::findOrfail($request->city_id);
        } catch (ModelNotFoundException $e) {
            if ($request->has('city_id')) {
//                return $this->noData();
            }
        };

        try {
            $h = App\Hospital::findOrfail($request->hospital_id);
        } catch (ModelNotFoundException $e) {
            if ($request->has('hospital_id')) {
//                return $this->noData();
            }
        };

        try {
            $i = App\Instance::findOrfail($request->instance_id);
        } catch (ModelNotFoundException $e) {
            if ($request->has('instance_id')) {
//                return $this->noData();
            }
        };

        // Get doctors via city_id, hospital_id, instance_id.
        $d = App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))->get();
        $data = [];

        if (isset($c)) {
            $temp = collect([]);
            foreach ($c->hospitals as $hospital) {
                $temp = $temp->merge($hospital->doctors);
            }
            $d = $d->intersect($temp);

            $data['city_id'] = $request->city_id;
        }

        if (isset($h)) {
            $d = $d->intersect($h->doctors);
            $data['hospital_id'] = $request->hospital_id;
        }

        if (isset($i)) {
            $d = $d->intersect($i->doctors);
            $data['instance_id'] = $request->instance_id;
        }

        if (count($d) == 0) {
            return $this->noData();
        }

        foreach ($d as $key => $doctor) {
            $d->put($key, [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'grading' => $doctor->grading,
                'hospital_id' => $doctor->hospital_id,
                'hospital_name' => $doctor->hospital->name
            ]);
        }
        $data['doctors'] = $d;
        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => $data
        ]);
    }



    // Doctor profile.
    public function getProfile(Request $request)
    {
        $doctor = App\Doctor::find(Auth::user()->role_id);
//        $doctor = App\Doctor::find(Auth::user()->id);

        return view('web.doctors.profile',[
            'doctor' => $doctor
        ]);

    }

    // Get condition_report.
    public function getCondition_report(Request $request)
    {
        $order = App\Order::find($request->id);

        return view('web.doctors.report',[
            'order'=> $order
        ]);

    }
}
