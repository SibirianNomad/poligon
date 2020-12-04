<?php


namespace App\DesignPatterns\Fundamental\Delegation;

use App\DesignPatterns\Fundamental\Delegation\Interfaces\MessageInterface;
use App\DesignPatterns\Fundamental\Delegation\Messengers\EmailMessengers;
use App\DesignPatterns\Fundamental\Delegation\Messengers\SmsMessengers;

class AppMessengers implements MessageInterface
{
  private $messenger;

  public function __construct()
  {
      $this->toEmail();
  }
  static public function getDescription(){
      return 'text';
  }
  public function toEmail(){
      $this->messenger=new EmailMessengers();
      return $this;
  }
    public function toSms(){
        $this->messenger=new SmsMessengers();
        return $this;
    }
    public function setSender($value): MessageInterface
    {
        $this->messenger->setSender($value);

        return $this->messenger;
    }
    public function setRecipient($value): MessageInterface
    {
        $this->messenger->setRecipient($value);

        return $this->messenger;
    }
    public function setMessage($value): MessageInterface
    {
        $this->messenger->setMessage($value);

        return $this->messenger;
    }
    public function send(): bool
    {
        return $this->messenger->send();
    }
}
