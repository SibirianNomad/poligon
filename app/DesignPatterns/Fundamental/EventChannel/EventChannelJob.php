<?php
namespace App\DesignPatterns\Fundamental\EventChannel;

use App\DesignPatterns\Fundamental\EventChannel\Classes\EventChannel;
use App\DesignPatterns\Fundamental\EventChannel\Classes\Publisher;
use App\DesignPatterns\Fundamental\EventChannel\Classes\Subcriber;

class EventChannelJob
{
    public function run(){
        $newChannel=new EventChannel();

        $highgardenGroup=new Publisher('highgarden-news',$newChannel);

        $winterfalNews=new Publisher('winterfal-news',$newChannel);
        $winterfalDaily=new Publisher('winterfal-news',$newChannel);

        $sansa=new Subcriber('Sansa Stark');
        $arya=new Subcriber('Arya Stark');
        $cercei=new Subcriber('Cercei Lannister');
        $snow=new Subcriber('Jon Snow');

        $newChannel->subscribe('highgarden-news',$cercei);
        $newChannel->subscribe('winterfal-news',$sansa);

        $newChannel->subscribe('highgarden-news',$arya);
        $newChannel->subscribe('winterfal-news',$arya);

        $newChannel->subscribe('winterfal-news',$snow);

        $highgardenGroup->publish('New highgarden post');
        $winterfalNews->publish('New winterfal post');
        $winterfalDaily->publish('New alternative winterfal post');

    }
    static function getDescription(){

    }
}
