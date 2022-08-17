<?php

namespace Database\Seeders;

use App\Common\Helpers\JsonParser;
use Base\Resource\Domain\Models\City;
use Base\Resource\Domain\Models\EducationCenter;
use Base\Resource\Domain\Models\Region;
use Illuminate\Database\Seeder;

class EducationCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new JsonParser('education_centers.json');
        $array = $data->toArray();
        $education_centers = $array;

        foreach ($education_centers as $education_center){

            $model = new EducationCenter();
            $model->region_id = Region::where('soato_id',substr($education_center['soato'],0,4))->first()->id;
            $model->city_id = City::where('soato_id',$education_center['soato'])->first()->id;
            $model->fill([
                'uz' => [
                    'name'=>$education_center['name']
                ],
                'ru' => [
                    'name'=>$education_center['name']
                ],
                'en' => [
                    'name'=>$education_center['name']
                ],
                'cyrl' => [
                    'name'=>$education_center['name']
                ]
            ]);
            $model->save();
        }
    }
}
