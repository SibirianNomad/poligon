<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

use App\Models\BlogPost as Model;


class BlogPostRepository extends CoreRepository
{
    protected function getModelClass(){
        return Model::class;
    }


}

