<?php

namespace App\Http\Controllers\cms;

use App\Doctor;
use App\Patient;
use App\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

             $reviews = collect();

             $doctors = Doctor::where('name', 'like', '%' . $request->q . '%')
                        ->orderBy(DB::raw('CONVERT(name USING gbk)'))
                        ->get();

             if ( count($doctors) > 0 ) {
                 foreach ( $doctors as $doctor ) {
                     $reviews = $reviews->merge($doctor->reviews);
                 }
             }

             $patients = Patient::where('name', 'like', '%' . $request->q . '%')
                        ->orderBy(DB::raw('CONVERT(name USING gbk)'))
                        ->get();

             if ( count($patients) > 0 ) {
                 foreach ( $patients as $patient ) {
                     $reviews = $reviews->merge($patient->reviews);
                 }
             }

            $reviews = $reviews->unique();

        } else {
            $reviews = Review::orderBy('created_at','desc')->get();
        }

        return view('cms.reviews.index', ['data' => $reviews, 'q' =>$request->q ]);
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
            'status'     => 'numeric',
            'created_at' => 'required|date_format:Y-m-d H:i:s'
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
        return view('cms.reviews.show', [
            'data' => $review,
            'patients' => Patient::orderBy('created_at','desc')->get(),
            'doctors'  => Doctor::orderBy('created_at','desc')->get()
        ]);
    }

    public function update (Request $request, Review $review)
    {
        $this->validate($request, [
            'patient_id' => 'required|integer',
            'doctor_id'  => 'required|integer',
            'reviews'    => 'required',
            'ratings'    => 'required|integer',
            'status'     => 'numeric',
            'created_at' => 'required|date_format:Y-m-d H:i:s'
        ]);

        $review->patient_id = $request->patient_id;
        $review->doctor_id  = $request->doctor_id;
        $review->reviews    = $request->reviews;
        $review->ratings    = $request->ratings;
        $review->status     = $request->has('status') ? 1 : -1;
        $review->created_at = $request->created_at;
        if ($request->has('published_at')) {
            $review->published_at = Carbon::now();
        }

        $review->save();

        return redirect('reviews');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect('reviews');
    }

}
