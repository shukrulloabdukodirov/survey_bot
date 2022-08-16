<?php

namespace Base\Survey\Infrastructure\Factories;

use Base\Survey\Domain\Models\SurveyTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurveyTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SurveyTranslation::class;

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
        'survey_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
