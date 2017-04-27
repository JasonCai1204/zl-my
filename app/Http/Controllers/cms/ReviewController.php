<?php

namespace App\Http\Controllers\cms;

use App\Doctor;
use App\Patient;
use App\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('master');
    }

    public function index (Request $request)
    {
        // TODO: Searching...
        if ($request->has('q')) {
             $doctors = Doctor::where('name', 'link', '%' . $request->q . '%')->get();
             $patient = Patient::where('name', 'link', '%' . $request->q . '%')->get();
             // ...
        }

        $reviews = Review::orderBy('created_at','desc')->get();
        return view('cms.reviews.index', ['data' => $reviews]);
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
            'status'     => 'numeric'
        ]);

        $review = new Review;
        $review->patient_id = $request->patient_id;
        $review->doctor_id  = $request->doctor_id;
        $review->reviews    = $request->reviews;
        $review->ratings    = $request->ratings;
        $review->status     = $request->has('status') ? 1 : -1;

        if ($request->has('published_at')) {
            $review->published_at = Carbon::now();
        }

        $review->save();

        return redirect('reviews');

    }

    public function show (Review $review)
    {
        return view('cms.reviews.show', ['data' => $review]);
    }

    public function update (Request $request, Review $review)
    {
        $this->validate($request, [
            'status' => 'numeric'
        ]);

        $review->status = $request->has('status') ?  1 : -1;
        $review->save();

        return redirect('reviews');
    }

}
