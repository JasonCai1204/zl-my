<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News_class extends Model
{
    public $timestamps = false;

    public function news ()
    {
        return $this->hasMany('App\News');
    }
}
