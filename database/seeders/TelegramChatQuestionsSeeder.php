<?php

namespace Database\Seeders;

use App\Common\Helpers\JsonParser;
use Base\Resource\Domain\Models\TelegramChatQuestion;
use Illuminate\Database\Seeder;

class TelegramChatQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new JsonParser('telegram_chat_questions.json');
        $array = $data->toArray();
        foreach ($array as $item) {
            $model = new TelegramChatQuestion();
            $model->fill([
                'question' => $item['question']
            ]);
            $model->save();
        }
    }
}
