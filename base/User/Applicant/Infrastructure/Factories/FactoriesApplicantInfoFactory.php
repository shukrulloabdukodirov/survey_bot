<?php

namespace Base\User\Applicant\Infrastructure\Factories;

use Base\User\Applicant\Domain\Models\ApplicantInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApplicantInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->word,
        'last_name' => $this->faker->word,
        'patronymic' => $this->faker->word,
        'nickname' => $this->faker->word,
        'passport' => $this->faker->word,
        'source' => $this->faker->word,
        'applicant_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
