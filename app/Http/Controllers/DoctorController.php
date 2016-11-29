<?php

namespace App\Http\Controllers;

use App\Http\Models as App;
use Carbon\Carbon;
use DB;
use Hash;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        return view('users.doctors.index',[
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

        $hospital_id = $doctor->hospital->id;

        return view('users.doctors.show',[
            'doctor' => $doctor,
            'doctor_id' => $id,
            'hospital_id' => $hospital_id
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
    public function getSignin()
    {
        return view('doctors.signin');
    }

    public function postSignin(Request $request)
    {
        // Validation.
//        dd($request->all());


        if(!$request->has('phone_number'))
        {
            return view('doctors/signin',
                [
                    'errors' => collect('请输入手机号码！')
                ]
            );
        }

        if(!$request->has('password'))
        {
            return view('doctors/signin',
                [
                    'errors' => collect('请输入密码！')
                ]
            );
        }

        if($input =$request->all() )
        {
            $rules = [
                'phone_number' => 'required|digits:11',
                'password' => 'required|'
            ];

            $message = [
                'phone_number.digits' => '请输入 11 位手机号码',
            ];

            $validator = Validator::make($input,$rules,$message);

            if($validator->passes()){

                // Find the doctor
                $doctor = App\Doctor::where('phone_number', $request->phone_number)
                        ->first();
                // Success.
                if (!$doctor)
                {
                        // Doctor not found.
                        return view('doctors/signin',
                            [
                                 'errors' => collect('请输入正确的手机号码！')
                            ]
                        );
                }else{
                    if(Hash::check($request->password, $doctor->password))
                    {
                        // The passwords match...
                        session(['doctor' => $doctor]);

                        return redirect('/doctor/orders');
                    }else{

                        // Password not found.
                        return view('doctors/signin',
                            [
                            'errors' => collect('请输入正确的密码！')
                            ]
                        );
                    }
                }
            }else{
                return back()->withErrors($validator);
            }
        }

    }

    // Reset password
    public function getReset()
    {
        return view('doctors.reset');
    }

    public function postReset(Request $request)
    {
        if(!$request->has('password'))
        {
            return view('doctors.reset',[
                'errors' => collect('请输入当前密码'),
            ]);
        }

        if(!$request->has('newPassword'))
        {
            return view('doctors.reset',[
                'errors' => collect('请输入新密码'),
            ]);
        }

        if(!$request->has('newPassword_confirmation'))
        {
            return view('doctors.reset',[
                'errors' => collect('请确认新密码'),
            ]);
        }

        if($input = $request->all())
        {
            $rules = [
                'password' => 'required|',
                'newPassword' => 'required|min:6|confirmed',
            ];

            $messages =[
                'password.required' => '请输入当前密码',
                'newPassword.required' => '请输入新密码',
                'newPassword.min' => '请输入不少于 6 位的新密码',
                'newPassword.confirmed' => '两次密码不一致'
            ];

            $validator = Validator::make($input,$rules,$messages);

            if($validator->passes())
            {
                $doctor = App\Doctor::find(session('doctor.id'));

                $password = $doctor->password;

                if(Hash::check($request->password,$password)){

                    $doctor->password = bcrypt($request->newPassword);

                    $doctor->save();

                    session(['doctor'=> $doctor]);

                    return redirect('doctor/profile');

                }else{
                    return view('doctors.reset',[
                        'errors' => collect('当前密码不正确！'),
                    ]);
                }
            }else{
                return back()->withErrors($validator);
            }
        }

    }



    //Select doctor
    public function getSelect()
    {

        $recommendDoctors = App\Doctor::where('is_recommended','1')
                ->get();

        $doctors = App\Doctor::all();


        return view('users.doctors.select',[
            'recommendDoctors' => $recommendDoctors,
            'doctors' => $doctors
        ]);
    }


//    //Select doctor from hospital
    public function getHospitalSelect(Request $request)
    {

        $hospitalDoctors = App\Doctor::where('hospital_id',$request->hospital_id)
                ->get();

        return view('users.doctors.select',[
            'hospitalDoctors' => $hospitalDoctors,
            'hospital_id' => $request->hospital_id
        ]);
    }

    // Select doctor from instance
    public function getInstanceSelect(Request $request)
    {
        $instance_id = $request->instance_id;

        $instance = App\Instance::where('id',$instance_id)
                ->get();

        $instanceDoctors = $instance->first()
                ->doctors;

        $instanceDoctor_id = $instanceDoctors
                ->first()->id;

        return view('users.doctors.select',[
            'instance_id' => $instance_id,
            'instanceDoctors'=> $instanceDoctors,
            'instanceDoctor_id' => $instanceDoctor_id
        ]);
    }

    // Doctor profile.
    public function getProfile(Request $request)
    {
        $doctor = App\Doctor::find(1);

        return view('doctors.profile',[
            'doctor' => $doctor
        ]);
    }

    // Get orders.
    public function getOrders(Request $request){

        $doctors = App\Doctor::find(session('doctor.id'))
                ->first();

        $orders = $doctors->orders;

        return view('doctors.order',[
            'orders' => $orders
        ]);
    }

    // Get condition_report.

    public function getCondition_report(Request $request){
        $order = App\Order::find($request->order_id);

        return view('doctors.report',[
            'order'=> $order
        ]);
    }

    // Sign out.
    public function signOut()
    {
        session(['doctor' => null]);

        return redirect('/doctor/signin');
    }

    // CMS
    public function create4cms(Request $request)
    {
        return view('cms.doctors.create', [
            'hospitals' => App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get(),
            'types' => App\Type::orderBy('sort')->get()
        ]);
    }

    public function store4cms(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:5',
            'avatar' => 'image|dimensions:min_width=100,min_height=100',
            'grading' => 'required|max:5',
            'phone_number' => 'digits:11',
            'hospital_id' => 'required|exists:hospitals,id',
            'instance_id' => 'required',
            'instance_id.*' => 'exists:instances,id',
            'introduction' => 'required',
            'password' => 'min:6'
        ]);

        $doctor = new App\Doctor;
        $doctor->name = $request->name;
        // Save image to storage and get path.
        if ($request->hasFile('avatar') && $request->avatar->isValid()) {
            $doctor->avatar = $request->avatar->storeAs('images/doctor/avatar/' . Carbon::now()->timestamp, $request->avatar->getClientOriginalName(), 'public');
        }
        $doctor->grading = $request->grading;
        $doctor->phone_number = $request->phone_number;
        $doctor->hospital_id = $request->hospital_id;
        $doctor->is_certified = $request->is_certified != null ? 1 : 0;
        $doctor->introduction = $request->introduction;
        $doctor->password = bcrypt($request->password);
        $doctor->is_recommended = $request->is_recommended != null ? 1 : 0;

        $doctor->save();

        foreach ($request->instance_id as $instance_id) {
            $doctor->instances()->attach($instance_id);
        }

        return redirect('doctors');
    }

    public function index4cms()
    {
        return view('cms.doctors.index', ['data' => App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))->get()]);
    }

    public function show4cms(App\Doctor $doctor)
    {
        return view('cms.doctors.show', [
            'data' => $doctor,
            'hospitals' => App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get(),
            'types' => App\Type::orderBy('sort')->get()
        ]);
    }

    public function update4cms(Request $request, App\Doctor $doctor)
    {
        $this->validate($request, [
            'name' => 'required|max:5',
            'avatar' => 'image|dimensions:min_width=100,min_height=100',
            'grading' => 'required|max:5',
            'phone_number' => 'digits:11',
            'hospital_id' => 'required|exists:hospitals,id',
            'instance_id' => 'required',
            'instance_id.*' => 'exists:instances,id',
            'introduction' => 'required'
        ]);

        $doctor->name = $request->name;
        // Save image to storage and get path.
        if ($request->hasFile('avatar') && $request->avatar->isValid()) {
            $doctor->avatar = $request->avatar->storeAs('images/doctor/avatar/' . Carbon::now()->timestamp, $request->avatar->getClientOriginalName(), 'public');
        }
        $doctor->grading = $request->grading;
        $doctor->phone_number = $request->phone_number;
        $doctor->hospital_id = $request->hospital_id;
        $doctor->is_certified = $request->is_certified != null ? 1 : 0;
        $doctor->introduction = $request->introduction;
        $doctor->is_recommended = $request->is_recommended != null ? 1 : 0;

        $doctor->save();

        $doctor->instances()->detach();
        foreach ($request->instance_id as $instance_id) {
            $doctor->instances()->attach($instance_id);
        }

        return redirect('doctors');
    }

    public function destroy4cms(App\Doctor $doctor)
    {
        $doctor->delete();

        return redirect('doctors');
    }

    public function resetPassword4cms(App\Doctor $doctor)
    {
        return view('cms.doctors.password', ['data' => $doctor]);
    }

    public function updatePassword4cms(Request $request, App\Doctor $doctor)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6'
        ]);

        $doctor->password = bcrypt($request->password);

        $doctor->save();

        return redirect('doctors/' . $doctor->id);
    }

}
