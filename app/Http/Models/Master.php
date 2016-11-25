<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Master extends Model
{
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function departments(){
        return $this->belongsTo('App\Http\Models\Department');
    }
}
