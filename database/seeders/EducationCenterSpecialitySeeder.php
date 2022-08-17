<?php

namespace Database\Seeders;

use Base\Application\Domain\Models\EducationCenterSpeciality;
use Base\Resource\Domain\Models\EducationCenter;
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
        foreach($eduCenters as $eduCenter){
            foreach ($specialities as $speciality){
                $model = new EducationCenterSpeciality();
                $model->education_center_id = $eduCenter->id;
                $model->speciality_id = $speciality->id;
                $model->save();
            }
        }
    }
}
