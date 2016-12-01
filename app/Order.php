<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at', 'send_to_the_doctor_at'];

    protected $casts = [
        'photos' => 'array'
    ];

    protected function hospital(){
        return $this->belongsTo('App\Hospital');
    }

    protected function doctor(){
        return $this->belongsTo('App\Doctor');
    }

    protected function instance(){
        return $this->belongsTo('App\Instance');
    }

    protected function user()
    {
        return $this->belongsTo('App\User');
    }
}