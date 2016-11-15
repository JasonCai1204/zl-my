<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo('App\Http\Models\City');
    }

    public function doctors(){
        return $this->hasMany('App\Http\Models\Doctor');
    }

}
