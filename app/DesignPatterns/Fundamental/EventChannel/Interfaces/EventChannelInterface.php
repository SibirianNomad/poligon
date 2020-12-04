<?php


namespace App\DesignPatterns\Fundamental\EventChannel\Interfaces;


interface EventChannelInterface
{
    public function publish($topic,$data);

    public function subscribe($topic,SubscriberInterface $subscriber);

}
