<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function doctors(){
        return $this->hasMany('App\Doctor');
    }

}
