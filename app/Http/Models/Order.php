<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

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
        return $this->belongsTo('App\Models\Instance');
    }
}
