<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionOption;

class QuestionController extends Controller
{
    public function edit(Question $question)
    {
        return view(
            'teacher.questions.edit',
            compact('question')
        );
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required',
            'correct_answer' => 'required',
            'points' => 'required|integer|min:1',
        ]);

        $question->update([

            'question_text' => $request->question_text,

            'correct_answer' => $request->correct_answer,

            'points' => $request->points,

        ]);

        // Update MCQ options

        if ($question->question_type == 'mcq') {

            $options = $question->options;

            foreach ($options as $index => $option) {

                $texts = [
                    $request->choice_a,
                    $request->choice_b,
                    $request->choice_c,
                    $request->choice_d,
                ];

                $option->update([

                    'option_text' => $texts[$index],

                    'is_correct' => $request->correct_answer == $texts[$index],

                ]);
            }
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Question updated successfully.'
            );
    }

    public function destroy(
        Question $question
    ) {
        $question->delete();

        return redirect()
            ->back()
            ->with(
                'success',
                'Question deleted successfully.'
            );
    }
    public function index(Exam $exam)
    {
        $questions = $exam->questions()
            ->latest()
            ->get();

        $totalQuestions = $questions->count();

        $totalPoints = $questions->sum('points');

        return view(
            'teacher.questions.index',
            compact(
                'exam',
                'questions',
                'totalQuestions',
                'totalPoints'
            )
        );
    }
    public function create(Exam $exam)
    {
        return view('teacher.questions.create', compact('exam'));
    }
    public function store(Request $request, Exam $exam)
    {

        $request->validate([

            'question_type' => 'required',

            'question_text' => 'required',

            'points' => 'required|integer|min:1',

        ]);

        // Determine correct answer

        if ($request->question_type == 'mcq') {

            $correctAnswer =
                $request->options[$request->correct_option];
        } elseif ($request->question_type == 'tf') {

            $correctAnswer =
                $request->correct_answer;
        } else {

            $correctAnswer =
                $request->identification_answer;
        }

        // Save question

        $question = Question::create([

            'exam_id' => $exam->id,

            'question_type' => $request->question_type,

            'question_text' => $request->question_text,

            'correct_answer' => $correctAnswer,

            'points' => $request->points,

        ]);

        // Save MCQ options

        if ($request->question_type == 'mcq') {

            foreach ($request->options as $index => $option) {

                QuestionOption::create([

                    'question_id' => $question->id,

                    'option_text' => $option,

                    'is_correct' => ($index == $request->correct_option),

                ]);
            }
        }

        return redirect()

            ->route('teacher.exams.questions', $exam->id)

            ->with(

                'success',

                'Question added successfully.'

            );
    }
}
