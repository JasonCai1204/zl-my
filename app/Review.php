<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }
}
