<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'info' => $this->faker->sentence(),
            'company_id' => 5,
            'email' => $this->faker->unique()->safeEmail(),
            'slug' => $this->faker->slug(),
            'phone' => $this->faker->phoneNumber(),
            'title' => 'Mr.',

        ];
    }
}
