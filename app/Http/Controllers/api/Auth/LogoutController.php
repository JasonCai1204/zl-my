<?php

namespace App\Http\Controllers\api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function logout(){

        Auth::user()->token()->revoke();

        return collect([
            'status' => 1,
            'msg' => '退出成功。'
        ]);
    }
}
