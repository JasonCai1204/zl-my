<?php

namespace App\Http\Controllers\api;

use App;
use App\Http\Controllers\Controller;
use Hash;
use Validator;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = App\Doctor::where('is_recommended', '1')->get();

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
            'data' => [
                'recommended' => $data['recommended'],
                'doctors' => $data['doctors']
            ]
        ])->toJson();

    }

    public function detail(Request $request)
    {
        $doctor = App\Doctor::findOrFail($request->doctor_id)->introduction;

        return collect([
            'status' => 1,
            'msg' => '加载成功',
            'data' => [
                'introduction' => $doctor
            ]
        ])->toJson();
    }


//Select doctor
    public function getSelect()
    {
        $recommendDoctors = App\Doctor::where('is_recommended', '1')->get();

        $doctors = App\Doctor::all();

        return view('users.doctors.select', [
            'recommendDoctors' => $recommendDoctors,
            'doctors' => $doctors
        ]);
    }


// Doctor profile.
    public function getProfile(Request $request)
    {
        $doctor = App\Doctor::find(1);

        return view('doctors.profile', [
            'doctor' => $doctor
        ]);
    }

// Get orders.
    public function getOrders(Request $request)
    {

        $doctors = App\Doctor::find(session('doctor.id'))
            ->first();

        $orders = $doctors->orders;

        return view('doctors.order', [
            'orders' => $orders
        ]);
    }

// Get condition_report.

    public function getCondition_report(Request $request)
    {
        $order = App\Order::find($request->order_id);

        return view('doctors.report', [
            'order' => $order
        ]);
    }

}
