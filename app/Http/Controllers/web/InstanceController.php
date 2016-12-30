<?php

namespace App\Http\Controllers\web;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InstanceController extends Controller
{
    //Select instance.
    public function getSelect(Request $request)
    {
        $data = [];

        // Get all sorted types & instances.
        $ins = collect([]);
        foreach (App\Type::orderBy('sort')->get() as $t) {
            foreach ($t->instances()->orderBy('sort')->get() as $i)
            $ins->push($i->id);
        }

        // Get all sorted types & instances via hospital_id.
        if ($request->has('hospital_id')) {
            $data['hospital_id'] = $request->hospital_id;

            try {
                $temp = collect([]);
                foreach (App\Hospital::findOrfail($request->hospital_id)->doctors as $d) {
                    foreach ($d->instances as $i) {
                        $temp->push($i->id);
                    }
                }
                $temp = $temp->unique();
                $ins = $ins->intersect($temp);
            } catch (ModelNotFoundException $e) {
                // TODO: return no data...
            }
        }

        // Get all sorted types & instances via doctor_id.
        if ($request->has('doctor_id')) {
            $data['doctor_id'] = $request->doctor_id;

            try {
                $temp = collect([]);
                foreach(App\Doctor::findOrfail($request->doctor_id)->instances as $i) {
                    $temp->push($i->id);
                }
                $ins = $ins->intersect($temp);
            } catch (ModelNotFoundException $e) {
                // TODO: return no data...
            }
        }

        if ($request->has('city_id')) {
            $data['city_id'] = $request->city_id;
        }
        if ($request->has('instance_id')) {
            $data['instance_id'] = $request->instance_id;
        }


        $t_i = [];
        foreach ($ins as $i) {
            $t_i[App\Instance::find($i)->type->id][] = $i;
        }
        $data['t_i'] = $t_i;

        return view('web.instances.select', $data);
    }

}
