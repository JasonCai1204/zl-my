<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Doctor extends Authenticatable
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function hospital(){
        return $this->belongsTo('App\Hospital')->orderBy(DB::raw('CONVERT(name USING gbk)'));
    }

    public function instances(){
        return $this->belongsToMany('App\Instance')->orderBy(DB::raw('CONVERT(name USING gbk)'));
    }

    public function orders(){
        return $this->hasMany('App\Order')->orderBy(DB::raw('CONVERT(name USING gbk)'));
    }
}
