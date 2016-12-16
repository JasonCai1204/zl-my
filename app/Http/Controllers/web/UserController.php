<?php

namespace App\Http\Controllers\web;

use App;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index()
    {
        if (isset(Auth::user()->id)) {

            $user = App\User::find(Auth::user()->id);

            return view('web.users.me', [
                'user' => $user
            ]);
        }
        return view('web.users.me');

    }

    // Get profile.
    public function getProfile(Request $request)
    {
        $user = App\User::find(Auth::user()->id);

        return view('web.users.profile', [
            'user' => $user
        ]);

    }

    // Post modify profile.
    public function postProfile(Request $request)
    {
        $user = App\User::find(Auth::user()->id);

        $this->validate($request, [
            'name' => 'required|max:5',
            'phone_number' => 'required|digits:11|unique:users,phone_number,' . $user->id,
        ], [
            'name.required' => '姓名不能为空。',
            'name.max' => '姓名不能超过 5 位。',
            'phone_number.required' => '手机号码不能为空。',
            'phone_number.digits' => '请输入 11 位手机号码。',
            'phone_number.unique' => '此手机号码已注册。',
        ]);

        $user->name = $request->name;

        $user->phone_number = $request->phone_number;

        $user->save();

        return redirect('/account');

    }

    // Get user orders.
    public function getOrders(Request $request)
    {
        $orders = App\Order::where('user_id', Auth::user()->id)->get();

        return view('web.orders.users', [
            'orders' => $orders
        ]);

    }

}
