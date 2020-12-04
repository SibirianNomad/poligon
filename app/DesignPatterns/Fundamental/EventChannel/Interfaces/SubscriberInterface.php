<?php


namespace App\DesignPatterns\Fundamental\EventChannel\Interfaces;


interface SubscriberInterface
{
    public function notify($data);
    public function getName();
}
