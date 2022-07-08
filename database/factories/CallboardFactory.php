<?php

namespace Database\Factories;

use Domain\Callboard\Models\Callboard;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CallboardFactory extends Factory
{
    protected $model = Callboard::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'state' => 'active',
            'is_publish' => true,
        ];
    }
}
