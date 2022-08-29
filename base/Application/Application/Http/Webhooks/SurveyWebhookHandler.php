<?php

namespace Base\Application\Application\Http\Webhooks;

use DefStudio\Telegraph\DTO\Chat;
use Base\Resource\Domain\Models\City;
use Base\Resource\Domain\Models\CityTranslation;
use Base\Resource\Domain\Models\EducationCenter;
use Base\Resource\Domain\Models\EducationCenterTranslation;
use Base\Resource\Domain\Models\Region;
use Base\Resource\Domain\Models\RegionTranslation;
use Base\Resource\Domain\Models\Speciality;
use Base\Resource\Domain\Models\SpecialityTranslation;
use Base\Resource\Domain\Models\TelegramChatQuestion;
use Base\Resource\Domain\Models\TelegramChatQuestionAnswer;
use Base\Survey\Domain\Models\Question;
use Base\User\Applicant\Domain\Models\Applicant;
use DefStudio\Telegraph\DTO\TelegramUpdate;
use DefStudio\Telegraph\Exceptions\TelegramWebhookException;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use Illuminate\Support\Str;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Stringable;

class SurveyWebhookHandler extends BaseWebHookHandler
{
    public function handle(Request $request, TelegraphBot $bot): void
    {
        parent::handle($request, $bot);
        $data=$request->all();
        Log::info($data);
      if(isset($data['message']))
      {
          $app=Applicant::where('chat_id','=',$data['message']['chat']['id'])->first();
          if(!$app)
          {
              $app= Applicant::create([
                  'chat_id'=>$data['message']['chat']['id']
              ]);
          }
          $this->applicant=$app;
          $chat=DB::table('telegraph_chats')->where('chat_id','=',$data['message']['chat']['id'])->get();
          if(!$chat)
          {
              $chat=$this->bot->chats()->create([
                  'chat_id'=>$data['message']['chat']['id'],
                  'name'=>$data['message']['chat']['first_name']
              ]);
          }

      }

    if(isset($data['message']['text'])&&$data['message']['text']==='/start')
    {
        $step=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'condition'=>true])->first();
        if($step)
        {
            $step->update(['condition'=>false]);
        }
        $step=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'telegram_chat_question_id'=>1])->first();
        if(!$step)
        {
            TelegramChatQuestionAnswer::create([
                'applicant_id'=>$this->applicant->id,
                'telegram_chat_question_id'=>1,
                'value'=>isset($data['message']['text'])?$data['message']['text']:'Some text',
                'condition'=>true
            ]);
        }
        else
        {
            $step->update(['condition'=>true]);
        }
    }
    // $this->NextStep();
    // $this->steps();
    }
    public function start()
    {
        Log::info($this->request->all());
        // $this->chat->message('<b>Assalomu alaykum </b>'.$this->message->from()->username())->send();
        // $this->chat->message('Marhamat so\'rovnomada ishtirok eting')->replyKeyboard(ReplyKeyboard::make()
        // ->button("So'rovnomada ishtirok etish")->resize(true))
        // ->send();
    }

    public function city($id){
        Log::info('contact-bor');
        $regions = Region::query()->find($id)->cities;
        $regionKeyboards = [];
        foreach ($regions as $region){
            $regionKeyboards[] =  ReplyButton::make($region->name);
        }
        $this->chat->message('<b>Tuman yoki shaharni tanlang</b>')->replyKeyboard(ReplyKeyboard::make()
        ->button('◀️Asosiy menyu')->width(0.5)->resize(true)
        ->button('🔙Orqaga')->width(0.5)->resize(true)
        ->row($regionKeyboards)->chunk(2))
        ->send();
    }

    public function educationCenter($id){
        $regions = Region::query()->find($id)->educationCenters;
        if($regions->isEmpty()){
            $this->chat->message('<b>O\'quv markazini topilmadi</b>')->send();
        }
        else{
            $regionKeyboards = [];
            foreach ($regions as $region){
                $regionKeyboards[] =  ReplyButton::make($region->name);
            }
            $this->chat->message('<b>O\'quv markazini tanlang</b>')
                ->replyKeyboard(ReplyKeyboard::make()
                ->row($regionKeyboards)->resize()
                ->row([
                    ReplyButton::make('◀️Asosiy menyu')->width(0.5),
                    ReplyButton::make('🔙Orqaga')->width(0.5)
                ])->resize()->chunk(1))
                ->send();
        }

    }
    public function specialities($id){
        // $specialities = EducationCenter::query()->find($id)-> specialities();
        $specialities = DB::table('education_center_specialities')
        ->select('speciality_translations.name')
        ->where('education_center_id','=',$id)
        ->join('speciality_translations', 'speciality_translations.speciality_id','=','education_center_specialities.speciality_id')
        ->where('speciality_translations.locale','=','uz')
        ->get();
        Log::info($specialities);
        if($specialities->isEmpty()){
            $this->chat->message('<b>Ushbu o\'quv markazda yo\'nalishlar topilmadi!</b>')->send();
        }
        else{
            $specialitieKeyboards = [];
            foreach ($specialities as $specialitiy){
                $specialitieKeyboards[] =ReplyButton::make($specialitiy->name)->webApp('https://172-105-76-165.ip.linodeusercontent.com/form');
            }
            $this->chat->message('<b>O\'qigan yo\'nalishingizni tanlang</b>')
                ->replyKeyboard(ReplyKeyboard::make()
                ->row($specialitieKeyboards)->resize()
                ->row([
                    ReplyButton::make('◀️Asosiy menyu')->width(0.5),
                    ReplyButton::make('🔙Orqaga')->width(0.5)
                ])->chunk(1)->resize()
                )
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
        $this->chat->message("Etiboringiz uchun rahmat!")->removeReplyKeyboard()->send();
    }

    // public function NextStep()
    // {

    //     $data=$this->request->all();
    //     if(isset($data['message']['text'])&&$data['message']['text']==='/start')
    //     {
    //         $step=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'condition'=>true])->first();
    //         if($step)
    //         {
    //             $step->update(['condition'=>false]);
    //         }
    //     }
    //     $step=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'condition'=>true])->first();
    //     if($step)
    //     {
    //         $step->update([
    //             'condition'=>false,
    //             'value'=>isset($data['message']['text'])?$data['message']['text']:'Some text'
    //         ]);
    //         $nextStep=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'telegram_chat_question_id'=>($step->telegram_chat_question_id??0)+1])->first();
    //         if(!$nextStep)
    //         {
    //               TelegramChatQuestionAnswer::create([
    //                 'applicant_id'=>$this->applicant->id,
    //                 'telegram_chat_question_id'=>$step->telegram_chat_question_id+1,
    //                 'value'=>isset($data['message']['text'])?$data['message']['text']:'Some text',
    //                 'condition'=>true
    //             ]);
    //         }

    //         else
    //         {
    //             $nextStep->update([
    //                 'condition'=>true
    //             ]);
    //         }

    //     }
    //     else
    //     {
    //         $nextStep=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'telegram_chat_question_id'=>1])->first();
    //         if(!$nextStep)
    //         {
    //             TelegramChatQuestionAnswer::create([
    //                 'applicant_id'=>$this->applicant->id,
    //                 'telegram_chat_question_id'=>1,
    //                 'value'=>isset($data['message']['text'])?$data['message']['text']:'some text',
    //                 'condition'=>true
    //             ]);
    //         }
    //         else
    //         {
    //             $nextStep->update(['condition'=>true]);
    //         }
    //     }
    //     // $this->steps();
    //     $this->step=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'condition'=>true])->first();
    //     Log::info($this->step);
    //     // $this->steps();
    // }
    public function steps()
    {
        $step=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'condition'=>true])->first();
        $message=$this->message->text();
        $checkMessage=$this->checkMessage($step);
        if($checkMessage)
        {
            $message=$checkMessage;
            $step=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'condition'=>true])->first();
        }
        Log::info($message);
        Log::info($step);
        $data=$this->request->all();
        $index=$step->telegram_chat_question_id;
        switch($index)
        {
            case 1:{
                $this->chat->message('<b>Assalomu alaykum </b>'.$this->message->from()->username())->send();
                $this->chat->message('Marhamat so\'rovnomada ishtirok eting')->replyKeyboard(ReplyKeyboard::make()
                ->button("So'rovnomada ishtirok etish")->resize(true))
                ->send();
                $this->nextStep($step);
            }break;
            case 2:{
                if($message==="So'rovnomada ishtirok etish")
                {
                    $this->chat->message('Rahmat!')
                    ->send();
                    $this->chat->message('<b>Telefon raqamingizni kiriting (+998********* Formatda)</b>'.$this->message->from()->username().' Iltimos telefon raqamingizni bizga yuboring.')->replyKeyboard(ReplyKeyboard::make()
                    ->button('🔙Orqaga')->width(0.5)->resize(true)
                    ->button('📱Telefon raqamni yuborish')->requestContact()->resize(true))
                    ->send();
                    $this->nextStep($step,$this->message->text());
                }
                else{
                    $this->chat->html("<b>Noto'g'ri ma'lumot jo'natildi!</b>")->send();
                    $this->chat->html("Iltimos to'g'ri buyruqni tanlang!")->send();
                }
            }break;
            case 3:{
                    if(isset($data['message']['contact']['phone_number']))
                    {
                        $phone=str_replace(['-',' ','+'],'',$data['message']['contact']['phone_number']);
                    }
                    else
                    {
                        $phone=str_replace(['-',' ','+'],'',$message);
                    }
                    if($phone=$this->checkPhone($phone))
                    {
                        $this->applicant->update([
                            'phone'=>intval($phone)
                        ]);
                        $regions = Region::all();
                        $regionKeyboards = [];
                        foreach ($regions as $region){
                            $regionKeyboards[] =  ReplyButton::make($region->name);
                        }
                        $this->chat->message('Rahmat!')
                            ->send();
                        $this->chat->message('<b>Viloyatni tanlang</b>')
                        ->replyKeyboard(ReplyKeyboard::make()
                        ->row($regionKeyboards)->chunk(2)
                        ->row([
                            \Base\Application\Application\Utils\Telegram\Buttons\ReplyButton::make('🔙Orqaga'),
                        ])->chunk(2)->selective(true))
                        ->send();
                        $this->nextStep($step,$phone);
                    }
                    else
                    {
                        $this->errorMessage("<b>Noto'g'ri  telefon raqam jo'natildi!</b>");
                        $this->errorMessage("Iltimos, qaytadan urunib ko'ring!");
                    }
            }break;
            case 4:{
                $region=RegionTranslation::where('name',$message)->first();
                if($region)
                {
                    $this->chat->message('Rahmat!')
                    ->send();
                    $this->educationCenter($region->region_id);
                    $this->nextStep($step,$this->message->text());
                }
                else
                {
                    $this->errorMessage("<b>Noto'g'ri viloyat tanlangan!</b>");
                    $this->errorMessage("Iltimos qaytadan urunib ko'ring!");
                }
            }break;

            // case 5:{
            //     $district=CityTranslation::where('name',$data['message']['text'])->first();
            //     $this->chat->message('Rahmat!')->removeReplyKeyboard()
            //     ->send();
            //     $this->educationCenter($district->city_id);
            //     $step->update(['condition'=>false]);
            //     $this->nextStep($step,$this->message->text());
            // }break;

            case 5:{
                if($message)
                {
                    $educationCenter=EducationCenterTranslation::where('name',$message)->first();
                    if($educationCenter)
                    {
                        $this->chat->message('Rahmat!')->removeReplyKeyboard()
                        ->send();
                        $this->specialities($educationCenter->education_center_id);
                        $this->nextStep($step,$this->message->text());
                    }
                    else
                    {
                        $this->errorMessage("<b>Noto'g'ri o'quv markazi  tanlangan!</b>");
                        $this->errorMessage("Iltimos qaytadan urunib ko'ring!");
                    }
                }
                else if(isset($data['message']['web_app_data']))
                {

                    Log::info($data['message']['web_app_data']['data']);  
                    // $step->update(['value'=>$data['message']['web_app_data']['button_text']]);
                    // if($data['message']['web_app_data']['data']==='Test yakunlandi')
                    // {
                    //     $this->finish();
                    //     $step->update(['condition'=>false]);
                    // }
                }
            }break;
        }
    }
    public function nextStep(TelegramChatQuestionAnswer $step,$value=null)
    {
        $data=$this->request->all();
        $index=$step->telegram_chat_question_id+1;
        if($value)
        {
           $previous=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'telegram_chat_question_id'=>$index-2])->first();
           if($previous)
           {
                $previous->update(['value'=>$value]);
           }
        }
        $questions=TelegramChatQuestion::all();
        $lastId=$questions[sizeof($questions)-1]->id;
        if($index<=$lastId)
        {
            $step->update([
                'condition'=>false,
            ]);
            $step=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'telegram_chat_question_id'=>$index])->first();
            if(!$step)
            {
                TelegramChatQuestionAnswer::create([
                    'applicant_id'=>$this->applicant->id,
                    'telegram_chat_question_id'=>$index,
                    'value'=>isset($data['message']['text'])?$data['message']['text']:'Some text',
                    'condition'=>true
                ]);
            }
            else
            {
                $step->update([
                    'condition'=>true
                ]);
            }
        }
        
        
    }

    public function checkMessage(TelegramChatQuestionAnswer $step)
    {
        $message=$this->message->text();
        switch($message)
        {
            case "🔙Orqaga":{
                $previous=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'telegram_chat_question_id'=>$step->telegram_chat_question_id-2])->first();
                if($previous)
                {
                    $step->update(['condition'=>false]);
                    $previous->update([
                        'condition'=>true
                    ]);
                    $doublePrevious=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'telegram_chat_question_id'=>$step->telegram_chat_question_id-3])->first();
                    if($doublePrevious)
                    {
                        return $doublePrevious->value;
                    }
                    else 
                    {
                        return '/start';
                    } 
                }
            }break;
            case "◀️Asosiy menyu":{
                $previous=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'telegram_chat_question_id'=>3])->first();
                if($previous)
                {
                    $step->update(['condition'=>false]);
                    $previous->update([
                        'condition'=>true
                    ]);
                    $doublePrevious=TelegramChatQuestionAnswer::where(['applicant_id'=>$this->applicant->id,'telegram_chat_question_id'=>$step->telegram_chat_question_id-3])->first();
                    if($doublePrevious)
                    {
                        return $doublePrevious->value;
                    }
                    else 
                    {
                        return '/start';
                    }  
                }
            }break;
        }
        return false;   
    }
    public function checkPhone($phone)
    {
        $check=false;
        if(is_numeric($phone))
        {
            if(strlen($phone)===9)
            {
                $phone='998'.$phone;
                $check=true;
            }
            else if(strlen($phone)===12)
            {
                $check=true;
            }
            else{
              return false;  
            }

            return $phone;
        }
        else 
        {
            return false;
        }
    }
    public function errorMessage($message)
    {
        Log::info($message);
        $this->chat->html($message)->send();
    }
}
