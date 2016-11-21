<?php

namespace App\Http\Controllers;

use App\Http\Models\Hospital;
use App\Http\Models as App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //redirect order/create
    public function getCreate(Request $request){
//        dd($request->all());
        // Select from hospital

        if($request->hospital_id && $request->doctor_id && $request->instance_id){

            $hospitals = App\Hospital::where('id', $request->hospital_id)
                    ->get();

            $doctors = App\Doctor::where('id',$request->doctor_id)
                    ->get();

            $instances = App\Instance::where('id',$request->instance_id)
                    ->get();

            return view('orders.create', [
                'hospitals' => $hospitals,
                'hospital_id' => $request->hospital_id,
                'doctors' => $doctors,
                'doctor_id' => $request->doctor_id,
                'instances' => $instances,
                'instance_id' => $request->instance_id
            ]);
        }

        if($request->hospital_id && $request->doctor_id){

            $hospitals = App\Hospital::where('id', $request->hospital_id)
                    ->get();

            $doctors = App\Doctor::where('id', $request->doctor_id)
                    ->get();

            return view('orders.create', [
                'hospitals' => $hospitals,
                'hospital_id' => $request->hospital_id,
                'doctors' => $doctors,
                'doctor_id'=> $request->doctor_id
            ]);
        }

        if($request->hospital_id ) {
            $hospitals = App\Hospital::where('id', $request->hospital_id)
                    ->get();

            return view('orders.create', [
                'hospitals' => $hospitals,
                'hospital_id' => $request->hospital_id
            ]);
        }

        // Select from doctor

        if($request->doctor_id && !$request->instance_id){

            $doctors = App\Doctor::where('id',$request->doctor_id)
                    ->get();

            $hospital_id = App\Doctor::find($request->doctor_id)
                    ->hospital->id;

            $hospitals = Hospital::where('id',$hospital_id)
                    ->get();

            return view('orders.create', [
                'hospitals' => $hospitals,
                'hospital_id' => $hospital_id,
                'doctors' => $doctors,
                'doctor_id' => $request->doctor_id,
            ]);
        }

        // Select from instance
            if($request->instance_id && !$request->doctor_id){

                $instances = App\Instance::where('id',$request->instance_id)
                        ->get();

                return view('orders.create', [
                    'instances' => $instances,
                    'instance_id' => $request->instance_id
                ]);
            }

            if($request->instance_id && $request->doctor_id){

                $instances = App\Instance::where('id',$request->instance_id)
                        ->get();

                $doctors = App\Doctor::where('id',$request->doctor_id)
                        ->get();

                $hospital_id =  $doctors->first()->hospital->id;

                $hospitals = Hospital::where('id',$hospital_id)
                        ->get();

                return view('orders.create', [
                    'hospitals' => $hospitals,
                    'hospital_id' => $hospital_id,
                    'doctors' => $doctors,
                    'doctor_id' => $request->doctor_id,
                    'instances' => $instances,
                    'instance_id' => $request->instance_id
                ]);

            }

        return view('orders.create');
    }

    // User post photos
    public function postPhotos(Request $request)
    {
        if($request->data){

            $fileName = $request->formdata['name'];

            $file = $request->data;

            $file = preg_replace('/data:.*;base64,/i', '', $file);

            $file = base64_decode($file);

            $now = Carbon::now();

//            $url = 'storage/images'
//                . $now->year
//                . '/'
//                . $now->month
//                . '/'
//                . $now->day
//                . '/'
//                . $now->timestamp
//                . '/'
//                . $request->formdata['name'];

            file_put_contents('storage/images/'.$fileName, $file);
        }

//            file_get_contents($url.'/'.$fileName,$file);

//            Storage::disk('public')
//                ->put($url, file_get_contents($url,$file));




//        }

//        dd($request->all());
        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $now = Carbon::now();

            $url = '/images/'
                . $now->year
                . '/'
                . $now->month
                . '/'
                . $now->day
                . '/'
                . $now->timestamp
                . '/'
                . $file->getClientOriginalName();

            Storage::disk('public')
                ->put($url, file_get_contents($file->getRealPath()));

            return collect([
                'file' => [
                    "name" => $file->getClientOriginalName(),
                    "url" => '/storage' . $url
                ]
            ])->toJson();
        }
    }


        // Get messages from orders.create
    public function postCreate(Request $request){
//                dd($request->data);
    }

    /**
     * CMS begin
     */
}
