<?php

namespace App\Http\Controllers;

use App\Department;
use App\Doctor;
use App\Master;
use App\Patient;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModifyController extends Controller
{
    public function migrateUsers()
    {
        // create $patient via foreach $users
        foreach (User::all() as $user)
        {
            $patient = new Patient();
            $patient->name = $user->name;
            $patient->phone_number = $user->phone_number;
            $patient->password = $user->password;
            $patient->remember_token = $user->remember_token;
            $patient->deleted_at = $user->deleted_at;
            $patient->created_at = $user->created_at;
            $patient->updated_at = $user->updated_at;

            $patient->save();
        }
    }


    public function modify()
    {

        // update $user via foreach $patients
        foreach (Patient::all() as $patient)
        {
            $user = User::find($patient->id);

            if (!$user){
                dd($patient->id);
            }
            $user->role_id = $patient->id;
            $user->role_type = 'App\Patient';

            $user->save();
        }


        foreach (Doctor::all() as $doctor)
        {
            if ($doctor->phone_number == User::where('phone_number',$doctor->phone_number)->value('phone_number') && $doctor->phone_number != '')
            {
                $user_id = User::where('phone_number',$doctor->phone_number)->value('id');

                $user = User::find($user_id);
                $user->name = $doctor->name;
                $user->role_id = $doctor->id;
                $user->role_type = 'App\Doctor';

                $user->save();
            }

            if ($doctor->phone_number != User::where('phone_number',$doctor->phone_number)->value('phone_number'))
            {
                $user = new User();
                $user->name = $doctor->name;
                $user->phone_number = $doctor->phone_number;
                $user->password = $doctor->password;
                $user->remember_token = $doctor->remember_token;
                $user->role_id = $doctor->id;
                $user->role_type = 'App\Doctor';

                $user->save();
            }

        }


        foreach (Master::all() as $master)
        {

            if ($master->phone_number == User::where('phone_number',$master->phone_number)->value('phone_number'))
            {
                $user_id = User::where('phone_number',$master->phone_number)->value('id');

                $user = User::find($user_id);
                $user->name = $master->name;
                $user->role_id = $master->id;
                $user->role_type = 'App\Master';

                $user->save();

            }

            if($master->phone_number != User::where('phone_number',$master->phone_number)->value('phone_number'))
            {
                $user = new User();
                $user->name = $master->name;
                $user->phone_number = $master->phone_number;
                $user->password = $master->password;
                $user->remember_token = $master->remember_token;
                $user->role_id = $master->id;
                $user->role_type = 'App\Master';

                $user->save();
            }

        }


        foreach (Master::all() as $master)
        {
            $department_id = $master->department_id;
            $id = Department::where('d_id',$department_id)->first()->id;
            $master->department_id = $id;

            $master->save();

        }

        foreach (User::all() as $user)
        {
            if ($user->phone_number == Patient::where('phone_number',$user->phone_number)->value('phone_number') && $user->role_type == 'App\Master')
            {
                Patient::where('phone_number',$user->phone_number)->delete();

            }
        }


    }



}

