<?php

namespace Base\Application\Application\Http\Webhooks;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;

class SurveyWebhookHandler extends \DefStudio\Telegraph\Handlers\WebhookHandler
{
    public function hi()
    {
        Telegraph::message('hello world')
            ->replyKeyboard(ReplyKeyboard::make()
                ->buttons([
                    ReplyButton::make('foo')->requestPoll(),
                    ReplyButton::make('bar')->requestQuiz(),
                    ReplyButton::make('baz')->webApp('https://webapp.dev'),
                ]))->send();
    }
}
