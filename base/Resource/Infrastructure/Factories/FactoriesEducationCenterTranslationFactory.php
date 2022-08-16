<?php

namespace Base\Resource\Infrastructure\Factories;

use Base\Resource\Domain\Models\EducationCenterTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationCenterTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EducationCenterTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'locale' => $this->faker->word,
        'education_center_id' => $this->faker->randomDigitNotNull
        ];
    }
}
