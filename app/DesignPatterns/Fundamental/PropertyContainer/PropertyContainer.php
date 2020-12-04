<?php


namespace App\DesignPatterns\Fundamental\PropertyContainer;


use App\DesignPatterns\Fundamental\PropertyContainer\Interfaces\PropertyContainerInterface;

class PropertyContainer implements PropertyContainerInterface
{
    private $propertyContainer=[];

    public static function getDescription(){

    }
    public function addProperty($propertyName, $value)
    {
       $this->propertyContainer[$propertyName]=$value;
    }

    public function deleteProperty($propertyName)
    {
        unset($this->propertyContainer[$propertyName]);
    }

    public function getProperty($propertyName)
    {
        return $this->propertyContainer[$propertyName] ?? null;
    }

    public function setProperty($propertyName, $value)
    {
        if(!isset($this->propertyContainer[$propertyName])){
            throw new \Exception("Property [{$propertyName}] not found");
        }
        $this->propertyContainer[$propertyName]=$value;
    }

}
