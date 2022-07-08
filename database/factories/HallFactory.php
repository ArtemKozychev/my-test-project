<?php

namespace Database\Factories;

use Domain\Hall\Models\Hall;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HallFactory extends Factory
{
    protected $model = Hall::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'number' => $this->faker->numberBetween(1,10),
            'seats' => $this->faker->numberBetween(30, 70),
            'state' => 'active',
        ];
    }
}
