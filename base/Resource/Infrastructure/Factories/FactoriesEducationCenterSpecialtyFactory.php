<?php

namespace Base\Resource\Infrastructure\Factories;

use Base\Resource\Domain\Models\EducationCenterSpecialty;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationCenterSpecialtyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EducationCenterSpecialty::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
