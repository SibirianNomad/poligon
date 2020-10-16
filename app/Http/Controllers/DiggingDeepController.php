<?php

namespace App\Http\Controllers;

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

        dd($result);
    }
}
