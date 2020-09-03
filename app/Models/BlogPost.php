<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    protected $table = 'blog_posts';
    use SoftDeletes;
    //отношения
    public function category(){
        return $this->belongsTo(BlogCategories::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
