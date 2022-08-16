<?php

namespace Base\Resource\Infrastructure\Factories;

use Base\Resource\Domain\Models\SpecialtyTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialtyTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecialtyTranslation::class;

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
        'specialty_id' => $this->faker->randomDigitNotNull
        ];
    }
}
