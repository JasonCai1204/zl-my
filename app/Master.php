<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Master extends Authenticatable
{
    use Notifiable;

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function department() {
        return $this->belongsTo('App\Department');
    }

    public function users()
    {
        return $this->morphMany('App\User', 'role');
    }
}
