<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
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
