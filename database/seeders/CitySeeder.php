<?php

namespace Database\Seeders;

use App\Common\Helpers\JsonParser;
use Base\Resource\Domain\Models\City;
use Base\Resource\Domain\Models\Region;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new JsonParser('cities.json');
        $array = $data->toArray();
        $cities = $array;
        foreach ($cities as $city){
            $model = new City();
            $model->region_soato_id = substr($city['soato'],0,4);
            $model->soato_id = $city['soato'];
            $model->fill([
                'uz' => [
                    'name'=>$city['name_uz']
                ],
                'ru' => [
                    'name'=>$city['name_ru']
                ],
                'en' => [
                    'name'=>$city['name_en']
                ],
                'cyrl' => [
                    'name'=>$city['name_cyrl']
                ]
            ]);
            $model->save();
        }
    }
}
