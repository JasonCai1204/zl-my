<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Type extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function instances() {
        return $this->hasMany('App\Instance');
    }

}