<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\BlogCategory as Model;


class BlogCategoryRepository extends CoreRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getEdit($id){
        return $this->startConditions()->find($id);
    }

    public function getComboBox(){
        // return $this->startConditions()->all();
        //two methods with repository
        $fields=implode(',',[
            'id',
            'CONCAT(id,". ",title) AS id_title'
        ]);

        $result=$this
        ->startConditions()
        ->selectRaw($fields)
        ->toBase()
        ->get();
        //dd($result);
        return $result;
    }

 public function getAllWithPaginate($countPage=null){

    $fields=[
        'id',
        'title',
        'parent_id'
    ];

    $result=$this
        ->startConditions()
        ->select($fields)
        ->with(['parentCategory:id,title'])
        ->paginate($countPage);

    return $result;

    }
}

