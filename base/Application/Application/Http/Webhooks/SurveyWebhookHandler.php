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
        Telegraph::message('hello world')
            ->keyboard(ReplyKeyboard::make()
                ->buttons([
                    ReplyButton::make('foo')->requestPoll(),
                    ReplyButton::make('bar')->requestQuiz(),
                    ReplyButton::make('baz')->webApp('https://webapp.dev'),
                ]))->send();
    }
}
