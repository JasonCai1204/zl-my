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
//    public function __construct()
//    {
//        $this->middleware('auth', ['only' => ['create','store','getPatientReviews']]);
//    }

      public function create (Doctor $doctor)
      {
          return view('web.reviews.create', ['doctor' => $doctor]);
      }

      public function store (Request $request)
      {
          $this->validate($request, [
              'doctor_id'  => 'required|integer',
              'reviews'    => 'required',
              'ratings'    => 'required|integer',
              'status'     => 'required|numeric',
          ]);

//          Validator::make([
//              'patient_id' => Auth::user()->id
//          ], [
//              'patient_id' => 'required'
//          ])->validate();

          $review = new Review;
//          $review->patient_id = Auth::user()->id;
          $review->patient_id = $request->patient_id;
          $review->doctor_id  = $request->doctor_id;
          $review->reviews    = $request->reviews;
          $review->ratings    = $request->ratings;
          $review->status     = $request->status;

          if ($request->has('published_at')) {
              $review->published_at = Carbon::now();
          }

          $review->save();
      }


    public function getDoctorReviews (Doctor $doctor)
    {
        return view('', [ 'ratings' => count( $doctor->reviews()->where('status',1)->get() ), 'reviews', $doctor->reviews()->where('status',1)->orderBy('created_at','desc')->take(15)->get() ]);
    }

    public function getPatientReviews (Patient $patient)
    {
        return view('', [ 'reviews', $patient->reviews()->where('status',1)->orderBy('created_at','desc')->take(15)->get() ]);
    }

    public function loadMoreDoctorReviews (Request $request, Doctor $doctor) {

        $count   = count( $doctor->reviews()->where('status',1)->orderBy('created_at','desc')->get() );

        $reviews = $doctor->reviews()->where('status',1)->orderBy('created_at','desc')->skip($request->skip)->take(15)->get();

        $count   = $count - ($request->skip + count( $reviews ));


    }

    public function loadMorePatientReviews (Request $request, Patient $patient) {

        $count   = count( $patient->reviews()->where('status',1)->orderBy('created_at','desc')->get() );

        $reviews = $patient->reviews()->where('status',1)->orderBy('created_at','desc')->skip($request->skip)->take(15)->get();

        $count   = $count - ( $request->skip + count( $reviews ) );

    }

}
