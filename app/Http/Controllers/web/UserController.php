<?php

namespace App\Http\Controllers\web;

use App;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($user_id = session('user.id')){

            $user = App\User::find($user_id);

            return view('users.account.account',[
                'user' => $user
            ]);
        }
        return view('users.account.account');
    }

    // Get profile.
    public function getProfile(Request $request)
    {
        $user = App\User::find($request->user_id);

        return view('users.account.profile',[
            'user'=>$user
        ]);
    }

    // Post modify profile.
    public function postProfile(Request $request)
    {

        if(!$request->name)
        {
            return view('users.account.profile',[
                'error'=> '姓名不能为空'
            ]);
        }

        if(!$request->phone_number)
        {
            return view('users.account.profile',[
                'error'=> '手机号码不能为空'
            ]);
        }

        if($request->name && $request->phone_number)
        {
            $user = App\User::where('phone_number',$request->phone_number)
                ->first();

            $user->name = $request->name;

            $user->save();

            session(['user' => $user]);

            return view('users.account.profile',[
                'user'=> $user
            ]);

        }

    }

    // User orders.
    public function getOrders(Request $request)
    {

        $orders = App\Order::where('user_id',$request->user_id)
            ->get();

        return view('users.account.order',[
            'orders'=>$orders
        ]);
    }

}
