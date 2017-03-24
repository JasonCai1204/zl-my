<?php

namespace App\Http\Controllers\api;

use App;
use App\Http\Controllers\Controller;
use App\Http\Instance;
use Illuminate\Http\Request;

class InstanceController extends Controller
{
    //Select instance.
    public function index(Request $request)
    {
        $data = [];

        foreach (App\Type::orderBy('sort')->get() as $type){

            foreach ($type->instances()->orderBy('sort')->get()  as  $instance){
                $data['i_a'][] = [
                    'id' => $instance->id,
                    'name' => $instance->name,
                    'type_id' => $instance->type_id,
                    'type_name' => $instance->type->name,
                    'sort' => $instance->sort
                ];
            }

        }

        $data = $data['i_a'];

        if ($request->has('hospital_id')){

            foreach (App\Hospital::find($request->hospital_id)->doctors as $doctor){

                foreach ($doctor->instances()->orderBy('type_id')->orderBy('sort')->get() as $instance){
                    $data['i_h'][] = [
                        'id' => $instance->id,
                        'name' => $instance->name,
                        'type_id' => $instance->type_id,
                        'type_name' => $instance->type->name,
                        'sort' => $instance->sort
                    ];
                }
            }


            foreach ($data as $key => $value) {
                if(in_array($value,$data['i_h'])){
                    $arr1[]=$value;
                }
            }

            $data = $arr1;
        }


        if ($request->has('doctor_id')){
            foreach (App\Doctor::find($request->doctor_id)->instances()->orderBy('type_id')->orderBy('sort')->get() as $instance){
                $data['i_i'][] = [
                    'id' => $instance->id,
                    'name' => $instance->name,
                    'type_id' => $instance->type_id,
                    'type_name' => $instance->type->name,
                    'sort' => $instance->sort
                ];
            }

            foreach ($data as $key => $value) {
                if(in_array($value,$data['i_i'])){
                    $arr2[]=$value;
                }
            }

            $data = $arr2;

        }

        return collect([
                'status' => 1,
                'msg' => '加载成功',
                'data' => ['instances' => $data]
            ])->toJson();

    }

}