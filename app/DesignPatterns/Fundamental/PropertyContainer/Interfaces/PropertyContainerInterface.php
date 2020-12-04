<?php


namespace App\DesignPatterns\Fundamental\PropertyContainer\Interfaces;


interface PropertyContainerInterface
{
    function addProperty($propertyName,$value);

    function deleteProperty($propertyName);

    function getProperty($propertyName);

    function setProperty($propertyName,$value);
}
