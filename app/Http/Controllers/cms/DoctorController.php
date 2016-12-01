<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function create(Request $request)
    {
        return view('cms.doctors.create', [
            'hospitals' => App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get(),
            'types' => App\Type::orderBy('sort')->get()
        ]);
    }

    public function store(Request $request)
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

    public function index()
    {
        return view('cms.doctors.index', ['data' => App\Doctor::orderBy(DB::raw('CONVERT(name USING gbk)'))->get()]);
    }

    public function show(App\Doctor $doctor)
    {
        return view('cms.doctors.show', [
            'data' => $doctor,
            'hospitals' => App\Hospital::orderBy(DB::raw('CONVERT(name USING gbk)'))->get(),
            'types' => App\Type::orderBy('sort')->get()
        ]);
    }

    public function update(Request $request, App\Doctor $doctor)
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

    public function destroy(App\Doctor $doctor)
    {
        $doctor->delete();

        return redirect('doctors');
    }

    public function resetPassword(App\Doctor $doctor)
    {
        return view('cms.doctors.password', ['data' => $doctor]);
    }

    public function updatePassword(Request $request, App\Doctor $doctor)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6'
        ]);

        $doctor->password = bcrypt($request->password);

        $doctor->save();

        return redirect('doctors/' . $doctor->id);
    }
}
