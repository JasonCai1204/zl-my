<?php

namespace App\Http\Controllers\cms;

use App;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('cms.users.index', ['data' => App\User::orderBy(DB::raw('CONVERT(name USING gbk)'))->get()]);
    }

    public function show(App\User $user)
    {
        return view('cms.users.show', ['data' => $user]);
    }

    public function update(Request $request, App\User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:70',
            'phone_number' => 'required|unique:users,phone_number,' . $user->id . '|digits:11'
        ]);

        $user->name = $request->name;
        $user->phone_number = $request->phone_number;

        $user->save();

        return redirect('users');
    }

    public function resetPassword(App\User $user)
    {
        return view('cms.users.password', ['data' => $user]);
    }

    public function updatePassword(Request $request, App\User $user)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6'
        ]);

        $user->password = bcrypt($request->password);

        $user->save();

        return redirect('users/' . $user->id);
    }

}
