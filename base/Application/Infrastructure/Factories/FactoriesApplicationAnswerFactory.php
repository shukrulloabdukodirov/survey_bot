<?php

namespace Base\Application\Infrastructure\Factories;

use Base\Application\Domain\Models\ApplicationAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationAnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApplicationAnswer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
