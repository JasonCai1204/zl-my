<?php

namespace App\Http\Controllers\api;

use App as App;
use App\Http\Controllers\Controller;
use Hash;
use Validator;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $doctors = App\Doctor::where('is_recommended','1')->get();

        $data = [];
        foreach ($doctors as $doctor) {
            $data['recommended'][] = [
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

        $doctors = App\Doctor::all();

        foreach ($doctors as $doctor) {
            $data['doctors'] [] = [
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
            'data' =>[
                'recommended' => $data['recommended'],
                'doctors' => $data['doctors']
            ]
        ])->toJson();

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

    public function detail(Request $request)
    {
        $doctor = App\Doctor::findOrFail($request->doctor_id)->introduction;
        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' =>[
                'introduction' => $doctor
            ]
        ])->toJson();
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

}
