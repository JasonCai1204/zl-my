<?php

namespace App\Http\Controllers\api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class testController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function test(Request $request){


//        dd(Auth::user()->token());


//        dd(Auth::user()->token()->revoke());
    }
}
