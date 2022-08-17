<?php

namespace Base\Application\Application\Http\Webhooks;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

class SurveyWebhookHandler extends \DefStudio\Telegraph\Handlers\WebhookHandler
{
    public function hi()
    {
        $this->chat->message('Hello bratish!!')->send(); //hi
    }
}
