<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    protected $table = 'blog_categories';
    const ROOT=1;

    protected $fillable=[
        'title',
        'parent_id',
        'slug',
        'description'
    ];
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class,'parent_id','id');
    }
    public function getParentTitleAttribute()
    {
        $title=$this->parentCategory->title ??
            ($this->isRoot()
                ? 'корень'
                : '???');

        return $title;

    }

    public function isRoot(){
        return $this->id === BlogCategory::ROOT;
    }
    //accessor
    public function getTitleAttribute($valueFromObject)
    {
        return mb_strtoupper($valueFromObject);
    }
    //mutator
    public function setTitleAttribute($incomingValue)
    {
        $this->attributes['title']=mb_strtolower($incomingValue);
    }
}
