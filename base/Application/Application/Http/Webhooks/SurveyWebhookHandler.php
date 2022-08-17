<?php

namespace Base\Application\Application\Http\Webhooks;

use Base\Resource\Domain\Models\Region;
use DefStudio\Telegraph\DTO\TelegramUpdate;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SurveyWebhookHandler extends \DefStudio\Telegraph\Handlers\WebhookHandler
{
    public function handle(Request $request, TelegraphBot $bot): void
    {
        parent::handle($request, $bot);

        if($this->message->contact()!==null){
            $regions = Region::all();
            $regionKeyboards = [];
            foreach ($regions as $region){
                $regionKeyboards[] =  Button::make($region->name)->action('region')->param('id', $region->id);
            }
            $this->chat->message('<b>Viloyatni tanlang</b>')->keyboard(Keyboard::make()
                ->buttons($regionKeyboards)->chunk(1))
                ->send();
        }
    }

    public function start()
    {
        $this->chat->message('<b>Assalomu alaykum </b>'.$this->message->from()->username().' Iltimos telefon raqamingizni bizga yuboring.')->replyKeyboard(ReplyKeyboard::make()
            ->buttons([
                ReplyButton::make('Telefon raqamni yuborish')->requestContact(),
            ])->chunk(1))
            ->send();
    }

    public function region(){
        $id = $this->data->get('id');
        $regions = Region::query()->find($id)->cities;
        $regionKeyboards = [];
        foreach ($regions as $region){
            $regionKeyboards[] =  Button::make($region->name)->action('city')->param('id', $region->id);
        }
        $this->chat->message('<b>Tuman yoki shaharni tanlang</b>')->keyboard(Keyboard::make()
            ->buttons($regionKeyboards)->chunk(1))
            ->send();
    }
}
