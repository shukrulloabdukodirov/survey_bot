<?php

namespace Base\Application\Application\Http\Webhooks;

use Base\Application\Domain\Models\Application;
use Base\Application\Domain\Models\ApplicationAnswer;
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
use Base\User\Applicant\Domain\Models\ApplicantInfo;
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
    protected Application $application;
    protected ApplicantInfo $applicantInfo;

    public function handle(Request $request, TelegraphBot $bot): void
    {
        parent::handle($request, $bot);
        $data = $request->all();
        Log::info($data);
        if (isset($data['message'])) {
            $this->applicant = Applicant::firstOrCreate(['chat_id' => $data['message']['chat']['id']]);

            $lastApplication = Application::where([
                'applicant_id' => $this->applicant->id
            ])->latest()->first();
            if ($lastApplication) {
                $this->application = $lastApplication;
            }
            $this->applicantInfo = ApplicantInfo::firstOrCreate([
                'applicant_id' => $this->applicant->id,
                'first_name' => $data['message']['chat']['first_name'],
                'nickname' => isset($data['message']['chat']['username']) ? $data['message']['chat']['username'] : ''
            ]);
            $chat = DB::table('telegraph_chats')->where('chat_id', '=', $data['message']['chat']['id'])->get();
            if (!$chat) {
                $chat = $this->bot->chats()->create([
                    'chat_id' => $data['message']['chat']['id'],
                    'name' => $data['message']['chat']['first_name']
                ]);
            }
        }

        if (isset($data['message']['text']) && $data['message']['text'] === '/start') {
            $step = TelegramChatQuestionAnswer::where(['applicant_id' => $this->applicant->id, 'condition' => true])->first();
            if ($step) {
                $step->update(['condition' => false]);
            }
            $step = TelegramChatQuestionAnswer::where(['applicant_id' => $this->applicant->id, 'telegram_chat_question_id' => 1])->first();
            if (!$step) {
                TelegramChatQuestionAnswer::create([
                    'applicant_id' => $this->applicant->id,
                    'telegram_chat_question_id' => 1,
                    'value' => isset($data['message']['text']) ? $data['message']['text'] : 'Some text',
                    'condition' => true
                ]);
            } else {
                $step->update(['condition' => true]);
            }
        }
        if (isset($this->applicant)) {
            $this->steps();
        }
    }
    public function start()
    {
    }

    public function city($id)
    {
        Log::info('contact-bor');
        $regions = Region::query()->find($id)->cities;
        $regionKeyboards = [];
        foreach ($regions as $region) {
            $regionKeyboards[] =  ReplyButton::make($region->name);
        }
        $this->chat->message('Tuman yoki shaharni tanlang')->replyKeyboard(ReplyKeyboard::make()
            ->button('◀️Asosiy menyu')->width(0.5)->resize(true)
            ->button('🔙Orqaga')->width(0.5)->resize(true)
            ->row($regionKeyboards)->chunk(2))
            ->send();
    }

    public function educationCenter($id)
    {
        $regions = Region::query()->find($id)->educationCenters;
        if ($regions->isEmpty()) {
            $this->chat->message('O\'quv markazi topilmadi')->send();
        } else {
            $keyboard = ReplyKeyboard::make()
                ->row([
                    ReplyButton::make($this->message->text() . ' ⬇️')
                ]);
            for ($i = 0; $i < count($regions); $i += 2) {
                if ($i + 1 < count($regions)) {
                    $keyboard
                        ->row([
                            ReplyButton::make($regions[$i]->name),
                            ReplyButton::make($regions[$i + 1]->name),
                        ]);
                } else {
                    $keyboard
                        ->row([
                            ReplyButton::make($regions[$i]->name),
                        ]);
                }
            }
            $keyboard = $keyboard
                ->row([
                    ReplyButton::make('🔙Orqaga')
                ])
                ->row([
                    ReplyButton::make('◀️Asosiy menyu'),
                ]);

            $this->chat->message('O‘zingiz tahsil olayotgan kasb-hunarga o‘qitish markazini tanlang')
                ->replyKeyboard($keyboard)
                ->send();
        }
    }
    public function specialities($id)
    {

        $firstApplication = Application::where([
            'applicant_id' => $this->applicant->id,
            'condition' => false
        ])->first();
        if ($firstApplication) {
            $specialities[] = Speciality::find($firstApplication->speciality_id);
        } else {
            $specialities = DB::table('education_center_specialities')
                ->select('speciality_translations.name')
                ->where('education_center_id', '=', $id)
                ->join('speciality_translations', 'speciality_translations.speciality_id', '=', 'education_center_specialities.speciality_id')
                ->where('speciality_translations.locale', '=', 'uz')
                ->get();
        }
        // $specialities = EducationCenter::query()->find($id)-> specialities();

        $region = TelegramChatQuestionAnswer::where(['applicant_id' => $this->applicant->id, 'telegram_chat_question_id' => 3])->first();


        if (count($specialities) === 0) {
            $this->chat->message('Ushbu o\'quv markazda yo\'nalishlar topilmadi!')->send();
        } else {
            $keyboard = ReplyKeyboard::make()
                ->row(
                    [
                        ReplyButton::make($region->value . ' ⬇️'),
                    ]
                )
                ->row([
                    ReplyButton::make($this->message->text() . ' ⬇️'),
                ]);
            for ($i = 0; $i < count($specialities); $i += 2) {
                if ($i + 1 < count($specialities)) {
                    $keyboard = $keyboard
                        ->row([
                            ReplyButton::make($specialities[$i]->name)->webApp('https://sorovnoma-bot.mehnat.uz/form'),
                            ReplyButton::make($specialities[$i + 1]->name)->webApp('https://sorovnoma-bot.mehnat.uz/form')
                        ]);
                } else {
                    $keyboard = $keyboard
                        ->row([
                            ReplyButton::make($specialities[$i]->name)->width(0, 75)->webApp('https://sorovnoma-bot.mehnat.uz/form'),
                        ]);
                }
            }
            $keyboard = $keyboard
                ->row([
                    ReplyButton::make('🔙Orqaga')
                ])
                ->row([
                    ReplyButton::make('◀️Asosiy menyu'),
                ]);
            $this->chat->message('O‘zingiz o‘qiyotgan kasbiy ta’lim yo‘nalishini tanlang')
                ->replyKeyboard(
                    $keyboard
                )
                ->send();
        }
    }


    public function question()
    {
        $id = $this->data->get('question_id');
        if (isset($id) && !empty($id)) {

            $nextUserId = Question::query()->where('id', '>', $id)->min('id');
            $question = Question::query()->find($nextUserId);
        } else {
            $id = 1;
            $question = Question::query()->find($id);
        }
        $regionKeyboards = [];
        Log::info($question);
        if ($question->type == 2) {
            foreach ($question->questionAnswers as $region) {
                $regionKeyboards[] =  Button::make($region->string)->action('question')->param('question_id', $question->id);
            }
            $this->chat->message("$question->text")
                ->keyboard(Keyboard::make()->buttons($regionKeyboards)->chunk(1))
                ->send();
        } else {
            $keyboard = ReplyKeyboard::make()
                ->inputPlaceholder("Waiting for input...")->resize(true)->selective(true);
            $this->chat->message("$question->text")
                ->replyKeyboard($keyboard
                    ->chunk(1))->send();
        }
    }

    public function finish()
    {
        $this->chat->message("Siz so‘rovnomadan muvaffaqiyatli o‘tdingiz! Kasbiy ta’lim sohasini yanada rivojlantirishga befarq bo‘lmaganingiz uchun tashakkur! So‘rovnomada yana ishtirok etish uchun 24 soatdan keyin qayta urinib ko‘rishingiz mumkin!")->removeReplyKeyboard()->send();
    }
    public function steps()
    {
        $step = TelegramChatQuestionAnswer::where(['applicant_id' => $this->applicant->id, 'condition' => true])->first();
        if (!$step) {
            $step = TelegramChatQuestionAnswer::firstOrCreate([
                'applicant_id' => $this->applicant->id,
                'telegram_chat_question_id' => 1,
                'condition' => true,
                'value' => '/start'
            ]);
        }
        $message = $this->message->text();
        $checkMessage = $this->checkMessage($step);
        if ($checkMessage) {
            $message = $checkMessage;
            $step = TelegramChatQuestionAnswer::where(['applicant_id' => $this->applicant->id, 'condition' => true])->first();
        }
        Log::info($message);
        Log::info($step);
        $data = $this->request->all();
        $index = $step->telegram_chat_question_id;
        switch ($index) {
            case 1: {
                    $this->chat->message('Assalomu alaykum! "Ishga marhamat" monomarkazlari va kasb-hunarga o‘qitish markazlari faoliyatini baholash maqsadida ishlab chiqilgan maxsus botga xush kelibsiz! So‘rovnomada ishtirokingiz uchun minnatdorchilik bildiramiz! Sizning xolis bahoyingiz kasbiy ta’lim kelajagini belgilashda muhim ahamiyatga ega!')->replyKeyboard(ReplyKeyboard::make()
                        ->button("So'rovnomada ishtirok etish")->resize(true))
                        ->send();
                    $this->nextStep($step);
                }
                break;
            case 2: {
                    if ($message === "So'rovnomada ishtirok etish") {
                        $lastApplication = Application::where([
                            'applicant_id' => $this->applicant->id
                        ])->latest()->first();
                        if ($lastApplication) {
                            if (!$lastApplication->condition) {
                                $date = strtotime($lastApplication->updated_at);
                                $now = time();
                                $diff = $now - $date;
                                if ($diff < 24 * 60 * 60) {
                                    $message = 'Siz so\'nggi 24 soatni ichida so\'rovnomadan o\'tgansiz. Siz ' . date('H:i:s', 24 * 60 * 60 - $diff) . ' vaqtdan so\'ng yana so\'rovnomadan qayta  o\'tishingiz mumkin!';
                                    $this->chat->message($message)->send();
                                    return;
                                } else {
                                    Application::create([
                                        'applicant_id' => $this->applicant->id
                                    ]);
                                }
                            }
                        } else {
                            Application::create([
                                'applicant_id' => $this->applicant->id
                            ]);
                        }
                        $this->chat->message('Telefon raqamingizni kiriting (+998 _ _   _ _ _  _ _  _ _) yoki saqlangan telefon raqamingizni yuborishni so‘raymiz!
    So‘rovnomada ishtirok etish uchun yuborgan telefon raqamingiz orqali faqat bitta kasbiy ta’lim markazi faoliyatini baholay olasiz!')->replyKeyboard(ReplyKeyboard::make()
                            ->button('🔙Orqaga')->width(0.5)->resize(true)
                            ->button('📱Telefon raqamni yuborish')->requestContact()->resize(true))
                            ->send();
                        $this->nextStep($step, $this->message->text());
                    } else {
                        $this->chat->html("Xato ma'lumot kiritildi.")->send();
                        $this->chat->html("Iltimos, to'g'ri buyruqni tanlang!")->send();
                    }
                }
                break;
            case 3: {
                    if (isset($data['message']['contact']['phone_number'])) {
                        $phone = str_replace(['-', ' ', '+'], '', $data['message']['contact']['phone_number']);
                    } else {
                        $phone = str_replace(['-', ' ', '+'], '', $message);
                    }
                    if ($phone = $this->checkPhone($phone)) {
                        $this->applicant->update([
                            'phone' => intval($phone)
                        ]);
                        $regions = Region::all();
                        $regionKeyboards = [];
                        foreach ($regions as $region) {
                            $regionKeyboards[] =  ReplyButton::make($region->name);
                        }
                        $this->chat->message('Marhamat, siz o‘qiyotgan "Ishga marhamat" monomarkazi yoki kasb-hunarga o‘qitish markazi joylashgan hududni tanlang')
                            ->replyKeyboard(ReplyKeyboard::make()
                                ->row($regionKeyboards)->chunk(2)
                                ->row([
                                    \Base\Application\Application\Utils\Telegram\Buttons\ReplyButton::make('🔙Orqaga'),
                                ])->chunk(2)->selective(true))
                            ->send();
                        $this->nextStep($step, $phone);
                    } else {
                        $this->errorMessage("Xato ma'lumot kiritildi.");
                        $this->errorMessage("Iltimos, qaytadan urinib ko'ring!");
                    }
                }
                break;
            case 4: {
                    $region = RegionTranslation::where('name', $message)->first();
                    if ($region) {
                        $this->educationCenter($region->region_id);
                        $this->nextStep($step, $this->message->text());
                    } else {
                        $this->errorMessage("Xato ma'lumot kiritildi.");
                        $this->errorMessage("Iltimos, qaytadan urinib ko'ring!");
                    }
                }
                break;
            case 5: {
                    if ($message) {
                        $educationCenter = EducationCenterTranslation::where('name', $message)->first();
                        if ($educationCenter) {
                            $firstApplication = Application::where([
                                'applicant_id' => $this->applicant->id,
                                'condition' => false
                            ])->first();
                            if ($firstApplication) {
                                if ($educationCenter->education_center_id !== $firstApplication->education_center_id) {
                                    $firstEducationCenter = EducationCenter::find($firstApplication->education_center_id)->name;
                                    $firstSpeciality = Speciality::find($firstApplication->speciality_id)->name;
                                    $message = "So‘rovnomada ishtirok etish uchun yuborgan telefon raqamingiz orqali faqat bitta kasbiy ta’lim markazi faoliyatini baholay olasiz!";
                                    $this->chat->message($message)->send();
                                    $message = "Siz ushbu raqam orqali \"" . $firstEducationCenter . "\"ning   \"" . $firstSpeciality . "\" yo'nalishiga ovoz bergansiz.";
                                    $this->chat->message($message)->send();
                                    return;
                                }
                            }
                            $this->specialities($educationCenter->education_center_id);
                            $this->application->update([
                                'education_center_id' => $educationCenter->education_center_id
                            ]);
                            $this->nextStep($step, $this->message->text());
                        } else {
                            $this->errorMessage("Xato ma'lumot kiritildi.");
                            $this->errorMessage("Iltimos, qaytadan urinib ko'ring!");
                        }
                    } else if (isset($data['message']['web_app_data'])) {
                        $speciality = $data['message']['web_app_data']['button_text'];
                        $step->update(['value' => $speciality]);
                        $answers = $data['message']['web_app_data']['data'];
                        $speciality_id = SpecialityTranslation::where(['name' => $speciality])->first()->speciality_id;
                        $this->application->update(['speciality_id' => $speciality_id]);
                        $this->finish();
                        if ($answers) {
                            $this->saveAnswers($answers);
                            $step->update(['condition' => false]);
                        }
                    }
                }
                break;
        }
    }
    public function nextStep(TelegramChatQuestionAnswer $step, $value = null)
    {
        $data = $this->request->all();
        $index = $step->telegram_chat_question_id + 1;
        if ($value) {
            $previous = TelegramChatQuestionAnswer::where(['applicant_id' => $this->applicant->id, 'telegram_chat_question_id' => $index - 2])->first();
            if ($previous) {
                $previous->update(['value' => $value]);
            }
        }
        $questions = TelegramChatQuestion::all();
        $lastId = $questions[sizeof($questions) - 1]->id;
        if ($index <= $lastId) {
            $step->update([
                'condition' => false,
            ]);
            $step = TelegramChatQuestionAnswer::where(['applicant_id' => $this->applicant->id, 'telegram_chat_question_id' => $index])->first();
            if (!$step) {
                TelegramChatQuestionAnswer::create([
                    'applicant_id' => $this->applicant->id,
                    'telegram_chat_question_id' => $index,
                    'value' => isset($data['message']['text']) ? $data['message']['text'] : 'Some text',
                    'condition' => true
                ]);
            } else {
                $step->update([
                    'condition' => true
                ]);
            }
        }
    }

    public function checkMessage(TelegramChatQuestionAnswer $step)
    {
        $message = $this->message->text();
        $region = TelegramChatQuestionAnswer::where(['applicant_id' => $this->applicant->id, 'telegram_chat_question_id' => 3])->first();
        $educationCenter = TelegramChatQuestionAnswer::where(['applicant_id' => $this->applicant->id, 'telegram_chat_question_id' => 4])->first();

        if (isset($region) && $message === $region->value . " ⬇️") {
            return $this->mainMenu($step);
        } else if (isset($educationCenter) && $message === $educationCenter->value . " ⬇️") {
            return $this->goBack($step);
        }

        switch ($message) {
            case "🔙Orqaga": {
                    return $this->goBack($step);
                }
                break;
            case "◀️Asosiy menyu": {
                    return $this->mainMenu($step);
                }
                break;
        }
        return false;
    }
    public function checkPhone($phone)
    {
        $check = false;
        if (is_numeric($phone)) {
            if (strlen($phone) === 9) {
                $phone = '998' . $phone;
                $check = true;
            } else if (strlen($phone) === 12) {
                $check = true;
            } else {
                return false;
            }

            return $phone;
        } else {
            return false;
        }
    }
    public function errorMessage($message)
    {
        Log::info($message);
        $this->chat->html($message)->send();
    }
    public function saveAnswers($answers)
    {
        $answers = json_decode($answers);
        Log::info($answers);
        foreach ($answers as $answer) {
            $appAns = ApplicationAnswer::firstOrCreate(['application_id' => $this->application->id, 'question_id' => $answer->question_id]);
            $appAns->update([
                'question_answer_id' => isset($answer->answer_id) && is_numeric($answer->answer_id) ? $answer->answer_id : null,
                'answer_by_input' => isset($answer->answer_by_input) ? $answer->answer_by_input : null
            ]);
        }
        $this->application->update([
            'condition' => 0
        ]);
    }
    public function mainMenu(TelegramChatQuestionAnswer $step)
    {
        $previous = TelegramChatQuestionAnswer::where(['applicant_id' => $this->applicant->id, 'telegram_chat_question_id' => 3])->first();
        if ($previous) {
            $step->update(['condition' => false]);
            $previous->update([
                'condition' => true
            ]);
            $doublePrevious = TelegramChatQuestionAnswer::where(['applicant_id' => $this->applicant->id, 'telegram_chat_question_id' => $step->telegram_chat_question_id - 3])->first();
            if ($doublePrevious) {
                return $doublePrevious->value;
            } else {
                return '/start';
            }
        }
    }
    public function goBack(TelegramChatQuestionAnswer $step)
    {
        $previous = TelegramChatQuestionAnswer::where(['applicant_id' => $this->applicant->id, 'telegram_chat_question_id' => $step->telegram_chat_question_id - 2])->first();
        if ($previous) {
            $step->update(['condition' => false]);
            $previous->update([
                'condition' => true
            ]);
            $doublePrevious = TelegramChatQuestionAnswer::where(['applicant_id' => $this->applicant->id, 'telegram_chat_question_id' => $step->telegram_chat_question_id - 3])->first();
            if ($doublePrevious) {
                return $doublePrevious->value;
            } else {
                return '/start';
            }
        }
    }
}
