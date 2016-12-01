<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instance extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'type_id', 'sort'];

    public function type()
    {
        return $this->belongsto('App\Http\Models\Type');
    }

    public function doctors()
    {
        return $this->belongsToMany('App\Http\Models\Doctor');
    }
}
