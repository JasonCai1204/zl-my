<?php

namespace App\Http\Controllers\ys;

use App as App;
use Hash;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    //signIn
    public function getSignin()
    {
        return view('doctors.signin');
    }

    public function postSignin(Request $request)
    {
        if (!$request->has('phone_number')) {
            return view('doctors/signin',
                [
                    'errors' => collect('请输入手机号码！')
                ]
            );
        }

        if (!$request->has('password')) {
            return view('doctors/signin',
                [
                    'errors' => collect('请输入密码！')
                ]
            );
        }

        if ($input = $request->all()) {
            $rules = [
                'phone_number' => 'required|digits:11',
                'password' => 'required|'
            ];

            $message = [
                'phone_number.digits' => '请输入 11 位手机号码',
            ];

            $validator = Validator::make($input, $rules, $message);

            if ($validator->passes()) {
                // Find the doctor
                $doctor = App\Doctor::where('phone_number', $request->phone_number)
                    ->first();
                // Success.
                if (!$doctor) {
                    // Doctor not found.
                    return view('doctors/signin',
                        [
                            'errors' => collect('请输入正确的手机号码！')
                        ]
                    );
                } else {
                    if (Hash::check($request->password, $doctor->password)) {
                        // The passwords match...
                        session(['doctor' => $doctor]);

                        return redirect('/doctor/orders');
                    } else {

                        // Password not found.
                        return view('doctors/signin',
                            [
                                'errors' => collect('请输入正确的密码！')
                            ]
                        );
                    }
                }
            } else {
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
        if (!$request->has('password')) {
            return view('doctors.reset', [
                'errors' => collect('请输入当前密码'),
            ]);
        }

        if (!$request->has('newPassword')) {
            return view('doctors.reset', [
                'errors' => collect('请输入新密码'),
            ]);
        }

        if (!$request->has('newPassword_confirmation')) {
            return view('doctors.reset', [
                'errors' => collect('请确认新密码'),
            ]);
        }

        if ($input = $request->all()) {
            $rules = [
                'password' => 'required|',
                'newPassword' => 'required|min:6|confirmed',
            ];

            $messages = [
                'password.required' => '请输入当前密码',
                'newPassword.required' => '请输入新密码',
                'newPassword.min' => '请输入不少于 6 位的新密码',
                'newPassword.confirmed' => '两次密码不一致'
            ];

            $validator = Validator::make($input, $rules, $messages);

            if ($validator->passes()) {
                $doctor = App\Doctor::find(session('doctor.id'));

                $password = $doctor->password;

                if (Hash::check($request->password, $password)) {

                    $doctor->password = bcrypt($request->newPassword);

                    $doctor->save();

                    session(['doctor' => $doctor]);

                    return redirect('doctor/profile');

                } else {
                    return view('doctors.reset', [
                        'errors' => collect('当前密码不正确！'),
                    ]);
                }
            } else {
                return back()->withErrors($validator);
            }
        }
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

//        $doctors = App\Doctor::find(session('doctor.id'))
        $doctors = App\Doctor::find(1)
            ->first();

        $orders = $doctors->orders;

        return view('doctors.order',[
            'orders' => $orders
        ]);
    }

    // Get condition_report.

    public function getCondition_report(Request $request){
//        $order = App\Order::find($request->order_id);
        $order = App\Order::find(1);

        return view('doctors.report',[
            'order'=> $order
        ]);
    }

    // Sign out.
    public function signOut()
    {
        session(['doctor' => null]);

        return redirect('/signin');
    }


}

