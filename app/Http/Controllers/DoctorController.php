<?php

namespace App\Http\Controllers;

use App\Http\Models as App;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recommendDoctors = App\Doctor::where('is_recommended','1')
                            ->get();

        $doctors = App\Doctor::all();

        return view('doctors.doctor',[
            'recommendDoctors' => $recommendDoctors,
            'doctors' => $doctors
        ]);
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
        $doctor = App\Doctor::findOrFail($id);

        return view('doctors.show',[
           'doctor' => $doctor
        ]);
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


    //signIn
    public function getLogin(){
        return view('doctors.signin');
    }

    public function postLogin(Request $request){
        // Validation.

        if($input =$request->all() ){
            $rules = [
                'phone_number' => 'required|numeric',
                'password' => 'required|'
            ];

            $message = [
                'phone_number.required' => '请输入手机号码',
                'phone_number.password' => '请输入密码'
            ];

            $validator = Validator::make($input,$rules,$message);

            if($validator->passes()){
                //Find the doctor

                $doctor = App\Doctor::where('phone_number', $request->phone_number)
                        ->first();
                // Success.
                if ($doctor != null && Hash::check($request->password, $doctor->password)) {
                    // The passwords match...
                    session(['doctor' => $doctor]);
                    return redirect('/doctor/orders');
                }
                else{
                  // Staff not found.
                    return view('doctors/signin',['errors' => '号码或密码错误']);
                }

            }else{
                return back()->withErrors($validator);
            }
        }

    }

    //Select doctor
    public function getSelect(){


        $recommendDoctors = App\Doctor::where('is_recommended','1')
            ->get();

        $doctors = App\Doctor::all();


        return view('doctors.select',[
            'recommendDoctors' => $recommendDoctors,
            'doctors' => $doctors
        ]);
    }


//    //Select doctor from hospital
    public function getHospitalSelect(Request $request){

        $hospitalDoctors = App\Doctor::where('hospital_id',$request->hospital_id)
            ->get();

        return view('doctors.select',[
            'hospitalDoctors' => $hospitalDoctors,
            'hospital_id' => $request->hospital_id
        ]);
    }

    // Select doctor from instance
    public function getInstanceSelect(Request $request){
        $instance_id = $request->instance_id;

        $instance = App\Instance::where('id',$instance_id)->get();

        $instanceDoctors = $instance->first()->doctors;

        $instanceDoctor_id = $instanceDoctors->first()->id;

//        dd($doctor_id);

        return view('doctors.select',[
            'instance_id' => $instance_id,
            'instanceDoctors'=> $instanceDoctors,
            'instanceDoctor_id' => $instanceDoctor_id
        ]);
    }

//
//    public function postHospitalSelect(Request $request){
//        $hospitals = App\Hospital::where('id',$request->id)
//            ->get();
//
//        $doctors = App\Doctor::where('hospital_id',$request->id)
//                    ->get();
//
//        return view('orders/create',[
//            'hospitals' => $hospitals,
//            'doctors' => $doctors,
//        ]);
//    }



    //getOrders
    public function getOrders(Request $request){

//        $doctors = App\Doctor::where('id','1')
//                ->orders();

        dd('welcome');

//        return view('doctors.order',[
//            'orders' => $orders
//        ]);
    }

    /**
     * CMS begin
     */

}
