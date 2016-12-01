<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    public $incrementing = false;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function department(){
        return $this->belongsTo('App\Department');
    }
}
