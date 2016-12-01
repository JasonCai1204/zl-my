<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'avatar', 'grading', 'introduction', 'phone_number', 'password', 'hospital_id', 'is_certified', 'is_recommended'];

    public function hospital(){
        return $this->belongsTo('App\Http\Models\Hospital');
    }

    public function instances(){
        return $this->belongsToMany('App\Http\Models\Instance');
    }

    public function orders(){
        return $this->hasMany('App\Http\Models\Order');
    }
}
