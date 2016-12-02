<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Master extends Authenticatable
{
    public $incrementing = false;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function department() {
        return $this->belongsTo('App\Department');
    }
}
