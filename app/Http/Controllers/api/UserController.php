<?php

namespace App\Http\Controllers\api;

use App;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
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

    // Modify password.
    public function getReset()
    {
        return view('users.account.reset');
    }

    public function postReset(Request $request)
    {
        if(!$request->has('password'))
        {
            return view('users.account.reset',[
                'errors' => collect('请输入当前密码'),
            ]);
        }

        if(!$request->has('newPassword'))
        {
            return view('users.account.reset',[
                'errors' => collect('请输入新密码'),
            ]);
        }

        if(!$request->has('newPassword_confirmation'))
        {
            return view('users.account.reset',[
                'errors' => collect('请确认新密码'),
            ]);
        }

        if($input = $request->all())
        {
            $rules = [
                'password' => 'required|',
                'newPassword' => 'required|min:6|confirmed',
            ];

            $messages =[
                'password.required' => '请输入当前密码',
                'newPassword.required' => '请输入新密码',
                'newPassword.min' => '请输入不少于 6 位的新密码',
                'newPassword.confirmed' => '两次密码不一致'
            ];

            $validator = Validator::make($input,$rules,$messages);

            if($validator->passes())
            {
                $user = App\User::find(session('user.id'));

                $password = $user->password;


                if(Hash::check($request->password,$password)){

                    $user->password = bcrypt($request->newPassword);

                    $user->save();

                    session(['user'=>$user]);

                    return redirect('/account');

                }else{
                    return view('users.account.reset',[
                        'errors' => collect('当前密码不正确！'),
                    ]);
                }
            }else{
                return back()->withErrors($validator);
            }
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
