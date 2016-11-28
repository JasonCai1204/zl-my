<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    public $incrementing = false;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function department(){
        return $this->belongsTo('App\Http\Models\Department');
    }
}
