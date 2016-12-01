<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'grading', 'city_id', 'introduction', 'is_recommended'];

    public function city()
    {
        return $this->belongsTo('App\Http\Models\City');
    }

    public function doctors(){
        return $this->hasMany('App\Http\Models\Doctor');
    }

}
