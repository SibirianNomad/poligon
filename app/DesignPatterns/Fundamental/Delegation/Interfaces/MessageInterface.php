<?php

namespace App\DesignPatterns\Fundamental\Delegation\Interfaces;


interface MessageInterface
{
    public function setSender($value): MessageInterface;

    public function setRecipient($value): MessageInterface;

    public function setMessage($value): MessageInterface;

    public function send(): bool;
}
