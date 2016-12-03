<?php

namespace App\Http\Controllers\web;

use App;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset(Auth::user()->id)){

            $user = App\User::find(Auth::user()->id);

            return view('web.users.me',[
                'user' => $user
            ]);
        }
        return view('web.users.me');
    }

    // Get profile.
    public function getProfile(Request $request)
    {
        $user = App\User::find(Auth::user()->id);

        return view('web.users.profile',[
            'user'=>$user
        ]);
    }

    // Post modify profile.
    public function postProfile(Request $request)
    {

        if(!$request->name)
        {
            return view('web.users..profile',[
                'error'=> '姓名不能为空'
            ]);
        }

        if(!$request->phone_number)
        {
            return view('web.users..profile',[
                'error'=> '手机号码不能为空'
            ]);
        }

        if($request->name && $request->phone_number)
        {
            $user = App\User::where('phone_number',$request->phone_number)
                ->first();

            $user->name = $request->name;

            $user->phone_number = $request->phone_number;

            $user->save();

            return redirect('/account');

        }

    }

    // User orders.
    public function getOrders(Request $request)
    {
        $orders = App\Order::where('user_id',Auth::user()->id)
            ->get();

        return view('web.orders.users',[
            'orders'=>$orders
        ]);
    }

}
