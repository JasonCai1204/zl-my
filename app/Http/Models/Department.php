<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function masters(){
        return $this->hasMany('App\Http\Models\Master');
    }
}
