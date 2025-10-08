<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\UserQuizProgress;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $categories = Quiz::distinct('category')->pluck('category');
        return view('quizzes.index', compact('categories'));
    }
    public function show(Quiz $quiz)
    {
        // Eager load the questions relationship
        $quiz->load('questions');

        // Transform the questions data
        $quiz->questions->transform(function ($question) {
            // Decode the JSON options field
            $options = json_decode($question->options, true);

            // Format options based on the question type
            $formattedOptions = ($question->type === 'multiple-choice')
                ? collect($options)->map(function ($value, $key) {
                    return ['key' => $key, 'value' => $value];
                })->toArray()
                : [
                    ['key' => 'True', 'value' => 'True'],
                    ['key' => 'False', 'value' => 'False'],
                ];

            return [
                'id' => $question->id,
                'question' => $question->question,
                'type' => $question->type,
                'options' => $formattedOptions,
                'correct_answer' => $question->correct_answer,
            ];
        });

        return view('quizzes.show', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $score = 0;
        $answers = $request->answers;

        \Log::info('Submitted Answers:', $answers);

        foreach ($answers as $questionId => $answer) {
            $question = Question::find($questionId);

            if (!$question) {
                continue;
            }

            \Log::info('Question:', [
                'id' => $question->id,
                'question' => $question->question,
                'correct_answer' => $question->correct_answer,
                'submitted_answer' => $answer,
            ]);

            if ($question->type === 'true-false') {
                $correctAnswer = ($question->correct_answer === 'True') ? 'A' : 'B';
                $submittedAnswer = ($answer === 'True') ? 'A' : 'B';
            } else {
                $correctAnswer = $question->correct_answer;
                $submittedAnswer = $answer;
            }

            if ($correctAnswer === $submittedAnswer) {
                $score++;
            } else {
                \Log::info('Mismatch:', [
                    'question_id' => $question->id,
                    'expected' => $correctAnswer,
                    'actual' => $submittedAnswer,
                ]);
            }
        }

        \Log::info('Calculated Score:', ['score' => $score]);

        UserQuizProgress::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'score' => $score,
            'completed_at' => now(),
        ]);

        return redirect()->route('quizzes.show', $quiz)->with('success', "Ju shenuat $score nga " . $quiz->questions->count());
    }
    public function progress()
    {
        // Fetch the authenticated user's quiz progress
        $progress = UserQuizProgress::where('user_id', auth()->id())
            ->with('quiz') // Eager load the quiz relationship
            ->orderBy('completed_at', 'desc') // Sort by completion date
            ->get();


        // Pass the progress data to the view
        return view('quizzes.progress', compact('progress'));
    }


    public function showByCategory($category)
    {
        // Fetch quizzes for the selected category
        $quizzes = Quiz::where('category', $category)->get();

        if ($quizzes->isEmpty()) {
            abort(404, 'Category not found');
        }

        return view('quizzes.category', compact('quizzes', 'category'));
    }
}
