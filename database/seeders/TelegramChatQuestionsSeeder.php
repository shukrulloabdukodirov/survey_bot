<?php

namespace Database\Seeders;

use App\Common\Helpers\JsonParser;
use Illuminate\Database\Seeder;
use Base\Resource\Domain\Models\TelegramChatQuestion;
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
