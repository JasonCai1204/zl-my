<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Instance extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function type()
    {
        return $this->belongsto('App\Type')->orderBy(DB::raw('CONVERT(name USING gbk)'));
    }

    public function doctors()
    {
        return $this->belongsToMany('App\Doctor')->orderBy(DB::raw('CONVERT(name USING gbk)'));
    }
}
