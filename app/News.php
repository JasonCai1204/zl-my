<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at', 'published_at'];

    public function news_class() {
        return $this->belongsTo('App\News_class');
    }

}
