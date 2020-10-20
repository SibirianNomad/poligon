<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\BlogPost;

class DiggingDeepController extends Controller
{
    public function collections(){
        $result=[];

        $eloquentCollection=BlogPost::withTrashed()->get();

//        dd(__METHOD__,$eloquentCollection,$eloquentCollection->toArray());
        $collection=collect($eloquentCollection->toArray());
        //dd($collection,get_class($eloquentCollection),get_class($collection));
        $result['first']=$collection->first();
        $result['last']=$collection->last();
        $result['where']['data']=$collection
            ->where('category_id','>',8)
            ->values()
            ->keyBy('id');

        $result['where']['count']=$result['where']['data']->count();
        $result['where']['isEmpty']=$result['where']['data']->isEmpty();
        $result['where']['isNotEmpty']=$result['where']['data']->isNotEmpty();
        $result['where']['where_first']=$collection
            ->firstWhere('id','=',99);

        //базовая переменная не изменится, просто вернется другая запись

        $result['map']['all']=$collection->map(function ($item){
            $newItem=new \stdClass();
            $newItem->item_id=$item['id'];
            $newItem->item_title=$item['title'];
            $newItem->exists=is_null($item['deleted_at']);
            return $newItem;
        });
        $result['map']['not_exists']=$result['map']['all']
            ->where('exists','=',false)
            ->values()
            ->keyBy('item_id');

        //базова переменная изменится (трансформируется)

        $result['transform']['all']=$collection->transform(function ($item){
            $newItem=new \stdClass();
            $newItem->item_id=$item['id'];
            $newItem->item_title=$item['title'];
            $newItem->exists=is_null($item['deleted_at']);
            $newItem->created_at=Carbon::parse($item['created_at']);
            return $newItem;
        });

        $newItem1=new \stdClass();
        $newItem1->id=999;

        $newItem2=new \stdClass();
        $newItem2->id=888;

        //установить элемент в начало коллекции
//        $newItemFirst=$collection->prepend($newItem1)->first();
//        $newItemLast=$collection->push($newItem2)->last();
//        $pulleditem=$collection->pull(1);
        //dd(compact('newItemFirst','newItemLast','pulleditem','collection'));

        //Фильтрация

        $filtered=$collection->filter(function ($item){
            $byDay=$item->created_at->isFriday();
            $byDate=$item->created_at->day==14;

            $result=$byDay && $byDate;

            return $result;
        });
        //сортировка

        $sortedSimpleCollection=collect([6,2,1,5,5,6])->sort()->values();
        $sortedCollection=$collection->sortBy('created_at');
        dd($sortedSimpleCollection);



    }
}
