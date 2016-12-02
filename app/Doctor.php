<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function hospital(){
        return $this->belongsTo('App\Hospital');
    }

    public function instances(){
        return $this->belongsToMany('App\Instance');
    }

    public function orders(){
        return $this->hasMany('App\Order');
    }
}
