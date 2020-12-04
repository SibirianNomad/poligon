<?php

namespace App\DesignPatterns\Fundamental\Delegation\Messengers;



class EmailMessengers extends AbstractMessengers
{
    public function send(): bool
    {
        \Debugbar::info('Sent by '.__METHOD__);
        return parent::send();
    }
}
