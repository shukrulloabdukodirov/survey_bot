<?php

namespace Base\Application\Application\Http\Webhooks;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;

class SurveyWebhookHandler extends \DefStudio\Telegraph\Handlers\WebhookHandler
{
    public function start()
    {
        Telegraph::message('hello world')
            ->replyKeyboard(function(Keyboard $keyboard){
                return $keyboard
                    ->button('foo')->requestContact()
                    ->button('bar')->requestQuiz()
                    ->button('baz')->webApp('https://webapp.dev');
            })->send();
    }
}
