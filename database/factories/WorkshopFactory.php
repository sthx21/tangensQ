<?php

namespace Database\Factories;

use App\Models\Workshop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WorkshopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Workshop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'detail' => $this->faker->text(),
            'location' => 'Lüneburg',
            'start_date' => now()->addWeeks(2),
            'end_date' => now()->addWeeks(2)->addDays(2),

            'status' => 'inactive',
            'price' => '999',
            'additional_title' => $this->faker->shuffleString(),

            'cancellation_date' => now()->addWeeks(1),

        ];
    }
}
