<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    public function masters(){
        return $this->hasMany('App\Master');
    }
}
