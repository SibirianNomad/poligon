<?php


namespace App\DesignPatterns\Fundamental\EventChannel\Classes;

use App\DesignPatterns\Fundamental\EventChannel\Interfaces\EventChannelInterface;
use App\DesignPatterns\Fundamental\EventChannel\Interfaces\SubscriberInterface;
use DebugBar\DebugBar;

class EventChannel implements EventChannelInterface
{
    private $topic=[];

    public function subscribe($topic, SubscriberInterface $subscriber)
    {
        $this->topic[$topic][]=$subscriber;

        $msg="{$subscriber->getName()} подписан(-a) на [{$topic}]";
         \Debugbar::info($msg);
    }
    public function publish($topic, $data)
    {
        if(empty($this->topic[$topic])){
            return;
        }
        foreach ($this->topic[$topic] as $subscriber){
            $subscriber->notify($data);
        }
    }

}
