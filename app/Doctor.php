<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use SoftDeletes;

    use Notifiable;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
    ];

    public function hospital(){
        return $this->belongsTo('App\Hospital')->orderBy(DB::raw('CONVERT(name USING gbk)'));
    }

    public function instances(){
        return $this->belongsToMany('App\Instance');
    }

    public function orders(){
        return $this->hasMany('App\Order')->orderBy(DB::raw('CONVERT(name USING gbk)'));
    }

    public function users()
    {
        return $this->morphMany('App\User', 'role');
    }
}
