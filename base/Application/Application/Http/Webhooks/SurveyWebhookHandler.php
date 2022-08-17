<?php

namespace Base\Application\Application\Http\Webhooks;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Telegraph;

class SurveyWebhookHandler extends \DefStudio\Telegraph\Handlers\WebhookHandler
{
    public function start()
    {
        Telegraph::message('hello world')
            ->keyboard(Keyboard::make()->buttons([
                Button::make("🗑️ Delete")->action("delete")->param('id',1),
                Button::make("📖 Mark as Read")->action("read")->param('id', 1),
                Button::make("👀 Open")->url('https://test.it'),
            ])->chunk(2))->send();
    }
}
