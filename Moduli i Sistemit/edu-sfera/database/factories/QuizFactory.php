<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    public function definition()
    {
        $categories = ['Computer Science', 'Law', 'Banks and Finance', 'Marketing', 'Education', 'General Economy'];

        return [
            'category' => $this->faker->randomElement($categories),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }
}