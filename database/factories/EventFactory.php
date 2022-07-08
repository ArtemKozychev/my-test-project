<?php

namespace Database\Factories;

use Domain\Callboard\Models\Callboard;
use Domain\Event\Models\Event;
use Domain\Hall\Models\Hall;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'callboard_id' => Callboard::factory(),
            'hall_id' => Hall::factory(),
            'name' => $this->faker->name(),
            'date_start' => $this->faker->unique()->dateTime(),
            'date_end' => $this->faker->dateTime(),
        ];
    }
}
