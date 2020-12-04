<?php


namespace App\DesignPatterns\Fundamental\EventChannel\Classes;


use App\DesignPatterns\Fundamental\EventChannel\Interfaces\SubscriberInterface;

class Subcriber implements SubscriberInterface
{
    private $name;

    public function __construct($name)
    {
        $this->name=$name;
    }
    public function getName()
    {
        return $this->name;
    }

    public function notify($data)
    {
        $msg="{$this->getName()} оповещен(-a) данными [{$data}]";
        \DebugBar::debug($msg);
    }
}
