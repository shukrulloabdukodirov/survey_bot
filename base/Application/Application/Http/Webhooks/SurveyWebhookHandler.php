<?php

namespace Base\Application\Application\Http\Webhooks;

use Base\Resource\Domain\Models\City;
use Base\Resource\Domain\Models\CityTranslation;
use Base\Resource\Domain\Models\Region;
use Base\Resource\Domain\Models\RegionTranslation;
use Base\Survey\Domain\Models\Question;
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
        $data = $request->all();
        Log::info($request->all());
        if(isset($data['message']['contact'])&&!empty($data['message']['contact'])){
            Log::info('contact-bor');
            Log::info($request->all());
            $regions = Region::all();
            $regionKeyboards = [];
            foreach ($regions as $region){
                $regionKeyboards[] =  ReplyButton::make($region->name);
            }
            $this->chat->message('Rahmat!')->removeReplyKeyboard()
                ->send();
            $this->chat->message('<b>Viloyatni tanlang</b>')->replyKeyboard(ReplyKeyboard::make()->row($regionKeyboards)->chunk(2))
            ->send();
        }
        // if(isset($data['message']['text'])&&$data['message']['text']==="So'rovnomada ishtirok etish")
        // {   
        //     $this->chat->message('Rahmat!')->removeReplyKeyboard()
        //     ->send();
        //     $this->chat->message('<b>Telefon raqamingizni kiriting (+998 ** *** ** ** Formatda)</b>'.$this->message->from()->username().' Iltimos telefon raqamingizni bizga yuboring.')->replyKeyboard(\Base\Application\Application\Utils\Telegram\Buttons\ReplyKeyboard::make()
        //     ->row([
        //         \Base\Application\Application\Utils\Telegram\Buttons\ReplyButton::make('Send Phone')->requestContact()->action('salom')->param('id','suka')
        //     ])->selective(true))
        //     ->send();
        // }
        if(isset($data['message']['text']))
        {
            $region=RegionTranslation::where('name',$data['message']['text'])->first();
            $district=CityTranslation::where('name',$data['message']['text'])->first();
            if($region)
            {
                $this->chat->message('Rahmat!')->removeReplyKeyboard()
                ->send();
                $this->city($region->region_id);
            }
             else if($district)
             {
                $this->chat->message('Rahmat!')->removeReplyKeyboard()
                ->send();
                $this->educationCenter($district->city_id);
             }
        }
    }

    public function start()
    {
        $this->chat->message('<b>Assalomu alaykum </b>'.$this->message->from()->username())->send();
        $this->chat->message('Marhamat so\'rovnomada ishtirok eting')->replyKeyboard(\Base\Application\Application\Utils\Telegram\Buttons\ReplyKeyboard::make()
            ->row([
                \Base\Application\Application\Utils\Telegram\Buttons\ReplyButton::make("So'rovnomada ishtirok etish")->webApp('https://xorazm.mehnat.uz')
            ])->chunk(1)->resize(true)->selective(true))
            ->send();
    }

    public function city($id){
        Log::info('contact-bor');
        $regions = Region::query()->find($id)->cities;
        $regionKeyboards = [];
        foreach ($regions as $region){
            $regionKeyboards[] =  ReplyButton::make($region->name);
        }
        $this->chat->message('<b>Tuman yoki shaharni tanlang</b>')->replyKeyboard(ReplyKeyboard::make()
            ->row($regionKeyboards)->chunk(2))
            ->send();
    }
    public function educationCenter($id){
        $regions = City::query()->find($id)->educationCenters;
        if($regions->isEmpty()){
            $this->chat->message('<b>O\'quv markazini topilmadi</b>')->send();
        }
        else{
            $regionKeyboards = [];
            foreach ($regions as $region){
                $regionKeyboards[] =  ReplyButton::make($region->name);
            }
            $this->chat->message('<b>O\'quv markazini tanlang</b>')
                ->replyKeyboard(ReplyKeyboard::make()->row($regionKeyboards)->chunk(2))
                ->send();
        }

    }

    public function question(){
        $id = $this->data->get('question_id');
        if(isset($id)&&!empty($id)){

            $nextUserId = Question::query()->where('id', '>', $id)->min('id');
            $question = Question::query()->find($nextUserId);
        }
        else{
            $id = 1;
            $question = Question::query()->find($id);
        }
        $regionKeyboards = [];
        Log::info($question);
        if($question->type == 2){
            foreach ($question->questionAnswers as $region){
                $regionKeyboards[] =  Button::make($region->string)->action('question')->param('question_id', $question->id);
            }
            $this->chat->message("$question->text")
                ->keyboard(Keyboard::make()->buttons($regionKeyboards)->chunk(1))
                ->send();
        }
        else{
            $keyboard = ReplyKeyboard::make()
                ->inputPlaceholder("Waiting for input...")->resize(true)->selective(true);
            $this->chat->message("$question->text")
                ->replyKeyboard($keyboard
                    ->chunk(1))->send();
        }

    }

    public function finish(){
        $this->chat->message("Etiboringiz uchun rahmat!")->send();
    }
}
