<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','phone_number', 'password','role_id','role_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function role()
    {
        return $this->morphTo();
    }

    public function patientReview()
    {
        return $this->hasMany('App\Review', 'patient_id');
    }

    public function doctorReview()
    {
        return $this->hasMany('App\Review', 'doctor_id');
    }
}
