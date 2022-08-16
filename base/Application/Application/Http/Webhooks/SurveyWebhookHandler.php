<?php

namespace Base\Application\Application\Http\Webhooks;

class SurveyWebhookHandler extends \DefStudio\Telegraph\Handlers\WebhookHandler
{
    public function start()
    {
        $this->chat->message('Hello bratish!!')->send(); //hi
    }
}
