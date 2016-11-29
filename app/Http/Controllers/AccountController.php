<?php

namespace App\Http\Controllers;

use Hash;
use App\Http\Models as App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // signIn
    public function getSignIn()
    {
        return view('users.account.signin');
    }

    public function postSignIn(Request $request)
    {
        if(!$request->has('phone_number'))
        {
            return view('users.account.signin',
                [
                'message' => '请输入手机号码',
                ]
            );
        }

        if(!$request->has('password'))
        {
            return view('users.account.signin',
                [
                    'message' => '请输入密码',
                ]
            );
        }

        if(!$request->has('phone_number') && !$request->has('password'))
        {
            return view('users.account.signin',
                [
                    'message' => '请输入手机号码和密码',
                ]
            );
        }


        if($request->has('phone_number') && $request->has('password'))
        {

            $user = App\User::where('phone_number',$request->phone_number)
                    ->first();

            if(count($user)>0){
                if (Hash::check($request->password, $user->password)) {

                    session(['user' => $user]);

                    return redirect('/');

                }else{
                    return view('users.account.signin',
                        [
                            'message' => '请输入正确的密码',
                        ]
                    );
                }
            }else{
                return view('users.account.signin',
                    [
                        'message' => '请输入正确的手机号码',
                    ]
                );
            }
        }



    }

    // signUp
    public function getSignUp()
    {
        return view('users.account.signup');
    }

    public function postSignUp(Request $request)
    {

        if($input = $request->all()){
            $rules = [
                'name' => 'required',
                'phone_number' => 'required|digits:11',
                'password' => 'required|min:6|confirmed',
            ];

            $messages = [
                'name.required' => '请填写真实姓名',
                'phone_number.required' => '请填写手机号码',
                'phone_number.digits' => '请填写 11 位数字',
                'password.required' => '请输入密码',
                'password.min' => '请输入不少于 6 位的密码',
                'password.confirmed' => '密码不一致',
            ];

            $validator = Validator::make($input,$rules,$messages);
            if($validator->passes()){
                $user = App\User::create(
                    [
                        'name' => $request->name,
                        'phone_number' => $request->phone_number,
                        'password' => bcrypt($request->password),
                    ]
                );
                session(['user' => $user]);

                // 判断是否主动注册还是被动注册
                if(!$request->has('patient_name')){
                    return redirect('/orders/create');
                }

                return redirect('/');

            }else{
                return back()->withErrors($validator);
            }

        }
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

    // Sign out.
    public function signOut()
    {
        session(['user' => null]);

        return redirect('/account');
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
