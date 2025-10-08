<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserQuizProgressFactory extends Factory
{
    protected $casts = [
        'completed_at' => 'datetime', 
    ];
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'quiz_id' => \App\Models\Quiz::factory(),
            'score' => $this->faker->numberBetween(0, 15),
            'completed_at' => $this->faker->dateTimeThisYear,
        ];
    }
}