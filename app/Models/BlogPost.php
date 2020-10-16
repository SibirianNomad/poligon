<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    protected $table = 'blog_posts';
    use SoftDeletes;
    const UNKNOWN_USER=1;

    //отношения
    public function category(){
        return $this->belongsTo(BlogCategory::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    protected $fillable=[
        'title',
        'category_id',
        'slug',
        'title',
        'except',
        'content_raw',
        'published_at',
        'is_published'
    ];
}
