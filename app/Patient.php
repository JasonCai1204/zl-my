<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->morphMany('App\User', 'role');
    }
}
