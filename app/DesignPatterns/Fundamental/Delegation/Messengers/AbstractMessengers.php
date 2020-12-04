<?php

namespace App\DesignPatterns\Fundamental\Delegation\Messengers;

use App\DesignPatterns\Fundamental\Delegation\Interfaces\MessageInterface;


abstract class AbstractMessengers implements MessageInterface
{
    protected $sender;

    protected $recipient;

    protected $message;

    public function setRecipient($value): MessageInterface
    {
        $this->recipient=$value;

        return $this;
    }
    public function setSender($value): MessageInterface
    {
        $this->sender=$value;

        return $this;
    }
    public function setMessage($value): MessageInterface
    {
        $this->message=$value;

        return $this;
    }
    public function send(): bool
    {
        return true;
    }
}
