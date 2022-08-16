<?php

namespace Base\Resource\Infrastructure\Factories;

use Base\Resource\Domain\Models\CityTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CityTranslation::class;

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
        'city_id' => $this->faker->randomDigitNotNull
        ];
    }
}
