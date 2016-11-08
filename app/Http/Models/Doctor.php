<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function hospitals(){
        return $this->belongsTo('App\Http\Models\Hospital');
    }

    public function instances(){
        return $this->belongsToMany('App\Http\Models\Instance');
    }

    public function orders(){
        return $this->hasMany('App\Http\Models\Order');
    }
}
