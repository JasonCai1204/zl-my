<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at', 'published_at'];

    protected $fillable = ['title', 'cover_image', 'content', 'published_at'];
}
