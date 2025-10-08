<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $quizzes = Quiz::all();

        foreach ($quizzes as $quiz) {
            Question::factory()->count(10)->create(['quiz_id' => $quiz->id]); // 10 questions per quiz
        }
    }
}