<?php

namespace Base\Application\Application\Http\Webhooks;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;

class SurveyWebhookHandler extends \DefStudio\Telegraph\Handlers\WebhookHandler
{
    public function start()
    {
        $keyboard = ReplyKeyboard::make()
            ->button('Send Contact')->requestContact()
            ->button('Send Location')->requestLocation()
            ->oneTime();
        Telegraph::message('hello world')
            ->replyKeyboard(function(Keyboard $keyboard){
                return $keyboard
                    ->button('foo')->requestPoll()
                    ->button('bar')->requestQuiz()
                    ->button('baz')->webApp('https://webapp.dev');
            })->send();
    }
}
