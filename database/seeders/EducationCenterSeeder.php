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
            if($education_center['education_center']!=='#Н/Д'){
                $model = new EducationCenter();

                $model->region_id = Region::whereTranslation('name',$education_center['region'],'cyrl')->first()->id;
                $model->city_id = null;
                $model->fill([
                    'uz' => [
                        'name'=>ucfirst(strtolower($education_center['education_center']))
                    ],
                    'ru' => [
                        'name'=>ucfirst(strtolower($education_center['education_center']))
                    ],
                    'en' => [
                        'name'=>ucfirst(strtolower($education_center['education_center']))
                    ],
                    'cyrl' => [
                        'name'=>ucfirst(strtolower($education_center['education_center']))
                    ]
                ]);
                $model->education_center_type_id = str_contains($education_center['education_center'], 'MONOMARKAZI')?1:2;
                $model->save();
            }

        }
    }
}
