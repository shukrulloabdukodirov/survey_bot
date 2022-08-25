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

            $model = new Speciality();
            $model->fill([
                'uz' => [
                    'name'=>strtoupper($speciality['speciality'])
                ],
                'ru' => [
                    'name'=>strtoupper($speciality['speciality'])
                ],
                'en' => [
                    'name'=>strtoupper($speciality['speciality'])
                ],
                'cyrl' => [
                    'name'=>strtoupper($speciality['speciality'])
                ]
            ]);
            $model->save();

        }
    }
}
