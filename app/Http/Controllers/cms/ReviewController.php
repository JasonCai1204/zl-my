<?php

namespace App\Http\Controllers\cms;

use App\Doctor;
use App\Patient;
use App\Review;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function index ()
    {
        return view('cms.reviews.index',['reviews' => Review::orderBy('created_at','desc')->get()]);
    }

    public function create ()
    {
        return view('cms.reviews.create',[
            'patients' => Patient::orderBy('created_at','desc')->get(),
            'doctors'  => Doctor::orderBy('created_at','desc')->get()
        ]);
    }


    public function store (Request $request)
    {
        $this->validate($request, [
            'patient_id' => 'required|integer',
            'doctor_id'  => 'required|integer',
            'reviews'    => 'required',
            'ratings'    => 'required|integer',
            'status'     => 'required|numeric',
        ]);

        $review = new Review;
        $review->patient_id = $request->patient_id;
        $review->doctor_id  = $request->doctor_id;
        $review->reviews    = $request->reviews;
        $review->ratings    = $request->ratings;
        $review->status     = $request->status;

        if ($request->has('published_at')) {
            $review->published_at = Carbon::now();
        }

        $review->save();

        return redirect('reviews');

    }

}
