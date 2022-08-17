<?php

namespace Base\Application\Application\Http\Webhooks;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

class SurveyWebhookHandler extends \DefStudio\Telegraph\Handlers\WebhookHandler
{
    public function hi()
    {
        Telegraph::message('hello world')->send();
    }
}
