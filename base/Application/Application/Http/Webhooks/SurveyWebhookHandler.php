<?php

namespace Base\Application\Application\Http\Webhooks;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

class SurveyWebhookHandler extends \DefStudio\Telegraph\Handlers\WebhookHandler
{
    public function hi()
    {
        $this->chat->message('Hello bratish!!')->keyboard(Keyboard::make()->buttons([
            Button::make("🗑️ Delete")->action("delete")->param('id',1),
            Button::make("📖 Mark as Read")->action("read")->param('id', 1),
            Button::make("👀 Open")->url('https://test.it'),
        ])->chunk(2))->send(); //hi
    }
}
