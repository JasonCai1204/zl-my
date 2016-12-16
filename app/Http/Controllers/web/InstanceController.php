<?php

namespace App\Http\Controllers\web;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstanceController extends Controller
{
    //Select instance.
    public function getSelect(Request $request)
    {

        $data = [];

        $types = App\Type::all();

        if ($request->has('hospital_id')) {
            $ins = collect([]);
            foreach (App\Hospital::find($request->hospital_id)->doctors as $d) {
                foreach ($d->instances as $i) {
                    $ins->push($i);
                }
            }

            $data['hospital_id'] = $request->hospital_id;
        }

        if ($request->has('doctor_id')) {
            $ins = App\Doctor::find($request->doctor_id)->instances;

            $data['doctor_id'] = $request->doctor_id;
        }

        if ($request->has('instance_id'))
            $data['instance_id'] = $request->instance_id;

        if (isset($ins)) {
            $data['instances'] = $ins;
        }else{
            $data['types'] = $types;
        }

        return view('web.instances.select', $data);

    }

}
