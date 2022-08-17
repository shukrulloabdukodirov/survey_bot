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
        $keyboard = ReplyKeyboard::make()
            ->button('Text')
            ->button('Send Contact')->requestContact()
            ->button('Send Location')->requestLocation()
            ->button('Create Quiz')->requestQuiz()
            ->button('Create Poll')->requestPoll()
            ->button('Start WebApp')->webApp('https://web.app.dev');
        Telegraph::message('Assalomu alaykum')
            ->keyboard($keyboard)->send();
    }
}
