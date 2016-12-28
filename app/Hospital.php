<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Hospital extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function doctors(){
        return $this->hasMany('App\Doctor')->orderBy(DB::raw('CONVERT(name USING gbk)'));
    }

}
