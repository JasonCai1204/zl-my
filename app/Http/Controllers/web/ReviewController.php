<?php

namespace App\Http\Controllers\web;

use App\Doctor;
use App\Patient;
use App\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create','store','getPatientReviews']]);
    }

    public function create (Doctor $doctor)
    {
        return view('www.doctors.review', ['doctor' => $doctor]);
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'doctor_id'  => 'required|integer',
            'reviews'    => 'required',
            'ratings'    => 'required|integer'
        ]);

        $review = new Review;
        $review->patient_id = Auth::user()->id;
        $review->doctor_id  = $request->doctor_id;
        $review->reviews    = $request->reviews;
        $review->ratings    = $request->ratings;
        $review->status     = 0;

        if ($request->has('published_at')) {
            $review->published_at = Carbon::now();
        }

        $review->save();
    }


    public function getDoctorReviews (Doctor $doctor)
    {
        $avg = (Review::where([['status', 1],['doctor_id', $doctor->id]])->pluck('ratings'))->avg();

        if ($avg >= 4.5 ) {
            $avg = intval(ceil($avg));
        } else {
            $avg = intval(floor($avg));
        }

        //        return view('www.doctors.show', [
        //            'avg'  => $avg,
        //            'counts' => count($doctor->reviews()->where('status',1)->get()),
        //            'reviews' => $doctor->reviews()->where('status',1)->orderBy('created_at','desc')->take(15)->get()
        //        ]);
    }

    public function getPatientReviews (Patient $patient)
    {
        return view('', [ 'reviews', $patient->reviews()->where('status',1)->orderBy('created_at','desc')->take(15)->get() ]);
    }

    public function loadMoreDoctorReviews (Request $request, Doctor $doctor) {

        $count   = count( $doctor->reviews()->where('status',1)->orderBy('created_at','desc')->get() );
        $reviews = $doctor->reviews()->where('status',1)->orderBy('created_at','desc')->skip($request->skip)->take(3)->get();
        foreach ($reviews as $review) {
            $review->patientName = $review->patient->name;
        }
        $count   = $count - ($request->skip + count( $reviews ));

        return collect(['count' => $count, 'reviews' => $reviews])->toJson();

    }

    public function fix()
    {
        echo 'hello';
    }
}
