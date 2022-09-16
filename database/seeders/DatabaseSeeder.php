<?php

namespace Database\Seeders;

use Base\Resource\Domain\Models\City;
use Base\Survey\Domain\Models\Survey;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call([
           SurveySeeder::class,
           RegionSeeder::class,
           CitySeeder::class,
           EducationCenterTypeSeeder::class,
           EducationCenterSeeder::class,
           SpecialitySeeder::class,
           EducationCenterSpecialitySeeder::class,
           QuestionSeeder::class,
           PermissionsSeeder::class,
           AttachPermissionSeeder::class,
           TelegramChatQuestionsSeeder::class
       ]);
    }
}
