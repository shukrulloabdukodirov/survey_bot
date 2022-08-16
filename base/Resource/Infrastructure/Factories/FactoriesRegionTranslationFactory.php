<?php

namespace Base\Resource\Infrastructure\Factories;

use Base\Resource\Domain\Models\RegionTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegionTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RegionTranslation::class;

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
        'region_id' => $this->faker->randomDigitNotNull
        ];
    }
}
