<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'info' => $this->faker->sentence(),
            'main_email' => $this->faker->unique()->safeEmail(),
            'main_phone' => $this->faker->phoneNumber(),
            'hr_title' => 'Mr.',
            'hr_first_name' => $this->faker->firstName(),
            'hr_last_name' => $this->faker->lastName(),
            'hr_email' => $this->faker->unique()->safeEmail(),
            'hr_phone' => $this->faker->phoneNumber(),
            'hr_info' => $this->faker->sentence(),

        ];
    }
}
