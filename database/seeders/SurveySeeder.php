<?php

namespace Database\Seeders;

use App\Common\Helpers\JsonParser;
use Base\Survey\Domain\Models\Survey;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new JsonParser('surveys.json');
        $array = $data->toArray();
        foreach ($array as $item) {
            $model = new Survey();
            $model->fill([
                'uz' => [
                    'name'=>$item['name_uz']
                ],
                'ru' => [
                    'name'=>$item['name_ru']
                ],
                'en' => [
                    'name'=>$item['name_en']
                ],
                'cyrl' => [
                    'name'=>$item['name_cyrl']
                ]
            ]);
            $model->save();
        }
    }
}
