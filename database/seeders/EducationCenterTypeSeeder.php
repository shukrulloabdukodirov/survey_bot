<?php

namespace Database\Seeders;

use App\Common\Helpers\JsonParser;
use Base\Resource\Domain\Models\EducationCenter;
use Base\Resource\Domain\Models\EducationCenterType;
use Base\Resource\Domain\Models\Region;
use Illuminate\Database\Seeder;

class EducationCenterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new JsonParser('education_center_types.json');
        $array = $data->toArray();
        $education_centers = $array;

        foreach ($education_centers as $education_center){

            $model = new EducationCenterType();
            $model->fill([
                'uz' => [
                    'name'=>strtoupper($education_center['name_uz'])
                ],
                'ru' => [
                    'name'=>strtoupper($education_center['name_ru'])
                ],
                'en' => [
                    'name'=>strtoupper($education_center['name_en'])
                ],
                'cyrl' => [
                    'name'=>strtoupper($education_center['name_cyrl'])
                ]
            ]);
            $model->save();
        }
    }
}
