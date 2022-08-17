<?php

namespace Database\Seeders;

use App\Common\Helpers\JsonParser;
use Base\Survey\Domain\Models\Question;
use Base\Survey\Domain\Models\QuestionAnswer;
use Base\Survey\Domain\Models\Survey;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new JsonParser('questions.json');
        $array = $data->toArray();
        $survey = Survey::query()->find(1);
        foreach ($array as $item) {
            $model = new Question();
            $model->survey_id = $survey->id;
            $model->type = $item['type'];
            $model->fill([
                'uz' => [
                    'text'=>$item['name_uz']
                ],
                'ru' => [
                    'text'=>$item['name_uz']
                ],
                'en' => [
                    'text'=>$item['name_uz']
                ],
                'cyrl' => [
                    'text'=>$item['name_uz']
                ]
            ]);
            $model->save();
            if($item['type']==2){
                foreach ($item['answers'] as $answer){
                    $answerModel = new QuestionAnswer();
                    $answerModel->question_id = $model->id;
                    $answerModel->fill([
                        'uz' => [
                            'string'=>$answer['name']
                        ],
                        'ru' => [
                            'string'=>$answer['name']
                        ],
                        'en' => [
                            'string'=>$answer['name']
                        ],
                        'cyrl' => [
                            'string'=>$answer['name']
                        ]
                    ]);
                    $answerModel->save();
                }
            }
        }
    }
}
