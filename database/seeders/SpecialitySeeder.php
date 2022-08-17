<?php

namespace Database\Seeders;

use App\Common\Helpers\JsonParser;
use Base\Resource\Domain\Models\City;
use Base\Resource\Domain\Models\EducationCenter;
use Base\Resource\Domain\Models\Region;
use Base\Resource\Domain\Models\Speciality;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new JsonParser('specialities.json');
        $array = $data->toArray();
        $specialities = $array;

        foreach ($specialities as $speciality){

            foreach ($speciality['items'] as $item){
                $model = new Speciality();
                $model->fill([
                    'uz' => [
                        'name'=>$item
                    ],
                    'ru' => [
                        'name'=>$item
                    ],
                    'en' => [
                        'name'=>$item
                    ],
                    'cyrl' => [
                        'name'=>$item
                    ]
                ]);
                $model->save();
            }

        }
    }
}
