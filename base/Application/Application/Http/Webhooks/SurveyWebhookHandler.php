<?php

namespace Base\Application\Application\Http\Webhooks;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

class SurveyWebhookHandler extends \DefStudio\Telegraph\Handlers\WebhookHandler
{
    public function hi()
    {
        Telegraph::message('hello world')
            ->keyboard(Keyboard::make()->buttons([
                Button::make("🗑️ Delete")->action("delete")->param('id', $notification->id),
                Button::make("📖 Mark as Read")->action("read")->param('id', $notification->id),
                Button::make("👀 Open")->url('https://test.it'),
            ])->chunk(2))->send();
    }
}
