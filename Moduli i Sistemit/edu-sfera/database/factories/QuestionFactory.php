<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    public function definition()
    {
        $types = ['multiple-choice', 'true-false'];

        return [
            'quiz_id' => \App\Models\Quiz::factory(),
            'question' => $this->faker->sentence,
            'type' => $this->faker->randomElement($types),
            'options' => json_encode(['A' => 'Option A', 'B' => 'Option B', 'C' => 'Option C', 'D' => 'Option D']),
            'correct_answer' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
        ];
    }
}