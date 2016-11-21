<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function hospitals(){
        return $this->hasMany('App\Http\Models\Hospital');
    }
}
