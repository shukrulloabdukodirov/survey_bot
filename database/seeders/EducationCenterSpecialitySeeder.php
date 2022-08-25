<?php

namespace Database\Seeders;

use App\Common\Helpers\JsonParser;
use Base\Resource\Domain\Models\EducationCenter;
use Base\Resource\Domain\Models\EducationCenterSpeciality;
use Base\Resource\Domain\Models\Speciality;
use Illuminate\Database\Seeder;

class EducationCenterSpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eduCenters = EducationCenter::all();
        $specialities = Speciality::all();
        $data = new JsonParser('education_center_speciality.json');
        $array = $data->toArray();

        foreach($eduCenters as $eduCenter){
            foreach ($array as $sarray){
                if($sarray['education_center'] == $eduCenter->name){
                    $speciality = Speciality::whereTranslation('name',strtoupper($sarray['speciality']),'uz')->first();
                    if(!empty($speciality)){
                        $model = new EducationCenterSpeciality();
                        $model->education_center_id = $eduCenter->id;
                        $model->speciality_id = $speciality->id;
                        $model->save();
                    }

                }

            }
        }
    }
}
