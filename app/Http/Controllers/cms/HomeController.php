<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:master');
    }

    public function index()
    {
        return view('cms.home');
    }

    public function uploads()
    {
        return view('cms.demo.uploads');
    }

    public function postUpload(Request $request)
    {
        $paths = [];
        // foreach ($request->photos as $photo) {
        //     $paths[] = $photo->storeAs('images/demo', $photo->getClientOriginalName(), 'public');
        // }
        return ['paths' => $paths, 'attach' => $request->attach];
    }
}
