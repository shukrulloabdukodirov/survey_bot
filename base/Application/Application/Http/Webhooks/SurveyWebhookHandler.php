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
        $response = Telegraph::message('hello world')
            ->replyKeyboard(ReplyKeyboard::make()
                ->buttons([
                    ReplyButton::make('Contact')->requestContact(),
                ]))->send();
        file_put_contents('telegram.txt',$response->body());
    }
}
