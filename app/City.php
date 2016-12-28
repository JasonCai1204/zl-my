<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class City extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function hospitals(){
        return $this->hasMany('App\Hospital')->orderBy(DB::raw('CONVERT(name USING gbk)'));
    }
}
