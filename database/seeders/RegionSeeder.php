<?php

namespace Database\Seeders;

use App\Common\Helpers\JsonParser;
use Base\Resource\Domain\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new JsonParser('regions.json');
        $array = $data->toArray();
        $regions = $array['data'];
        foreach ($regions as $region) {
            $model = new Region();
            $model->soato_id = $region['soato_id'];
            $model->status = 1;
            $model->fill([
                'uz' => [
                    'name'=>$region['name_oz']
                ],
                'ru' => [
                    'name'=>$region['name_oz']
                ],
                'en' => [
                    'name'=>$region['name_oz']
                ],
                'cyrl' => [
                    'name'=>$region['name_oz']
                ]
            ]);
            $model->save();
        }


    }
}
