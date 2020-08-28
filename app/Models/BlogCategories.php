<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategories extends Model
{
    use SoftDeletes;

    protected $table = 'blog_categories';

    protected $fillable=[
        'title',
        'parent_id',
        'slug',
        'description'
    ];

}
