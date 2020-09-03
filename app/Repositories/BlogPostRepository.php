<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

use App\Models\BlogPost as Model;


class BlogPostRepository extends CoreRepository
{
    protected function getModelClass(){
        return Model::class;
    }
    public function getAllWithPaginate(){

        $fields=[
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result=$this
            ->startConditions()
            ->select($fields)
            ->orderBy('id','DESC')
            //->with(['user','category'])
                //делаем запрос таким образом чтобы возвращал только поля id и title
                ->with(['category'=>function($query){
                $query->select(['id','title']);
            },
                //или так
                'user:id,name'
                ])
            ->paginate(25);
       
        return $result;

    }


}

