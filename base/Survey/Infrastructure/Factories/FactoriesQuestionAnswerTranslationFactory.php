<?php

namespace Base\Survey\Infrastructure\Factories;

use Base\Survey\Domain\Models\QuestionAnswerTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionAnswerTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuestionAnswerTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'string' => $this->faker->text,
        'locale' => $this->faker->word,
        'question_answer_id' => $this->faker->randomDigitNotNull
        ];
    }
}
