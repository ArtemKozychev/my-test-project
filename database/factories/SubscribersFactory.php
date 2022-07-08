<?php

namespace Database\Factories;

use Domain\Subscription\Models\Subscribers;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscribersFactory extends Factory
{
    protected $model = Subscribers::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
