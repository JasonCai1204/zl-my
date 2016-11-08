<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instance extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function types()
    {
        return $this->belongsto('App\Http\Models\Type');
    }

    public function doctors()
    {
        return $this->belongsnamy('App\Http\Models\Doctor');
    }
}
