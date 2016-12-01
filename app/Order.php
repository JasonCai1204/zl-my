<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at', 'send_to_the_doctor_at'];

    protected $fillable = ['user_id', 'patient_name', 'phone_number', 'instance_id', 'hospital_id', 'doctor_id', 'gender', 'birthday', 'weight', 'smoking', 'wechat_id', 'detail', 'photos', 'condition_report', 'send_to_the_doctor_at'];

    protected $casts = [
        'photos' => 'array'
    ];

    protected function hospital(){
        return $this->belongsTo('App\Http\Models\Hospital');
    }

    protected function doctor(){
        return $this->belongsTo('App\Http\Models\Doctor');
    }

    protected function instance(){
        return $this->belongsTo('App\Http\Models\Instance');
    }

    protected function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }
}
