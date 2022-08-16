<?php

namespace Base\Survey\Infrastructure\Factories;

use Base\Survey\Domain\Models\QuestionTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuestionTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this->faker->text,
        'locale' => $this->faker->word,
        'question_id' => $this->faker->randomDigitNotNull
        ];
    }
}
