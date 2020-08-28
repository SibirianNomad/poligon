<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
    //класс от которого наследуются все репозитории
abstract class CoreRepository
{
    //модель 
    protected $model;
    //создание модели определенной таблицы
    public function __construct (){
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    protected function startConditions(){
        return clone $this->model;
    }
}