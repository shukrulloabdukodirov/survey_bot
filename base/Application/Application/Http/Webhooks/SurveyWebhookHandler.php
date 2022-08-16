<?php

namespace Base\Application\Application\Http\Webhooks;

class SurveyWebhookHandler extends \DefStudio\Telegraph\Handlers\WebhookHandler
{
    public function hi()
    {
        $this->chat->message('Hello')->send(); //hi
    }
}
