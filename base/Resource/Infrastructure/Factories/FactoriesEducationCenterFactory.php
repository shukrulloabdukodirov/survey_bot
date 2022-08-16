<?php

namespace Base\Resource\Infrastructure\Factories;

use Base\Resource\Domain\Models\EducationCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationCenterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EducationCenter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->word,
        'region_id' => $this->faker->randomDigitNotNull,
        'city_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
