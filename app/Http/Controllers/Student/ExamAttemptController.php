<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;

class ExamAttemptController extends Controller
{
    public function enterCode()
    {
        return view('student.enter-code');
    }

    public function showCodeForm()
    {
        return view('student.enter-code');
    }

    /*
    |--------------------------------------------------------------------------
    | Enter Exam Code
    |--------------------------------------------------------------------------
    */
    public function startExam(Request $request)
    {
        $request->validate([
            'exam_code' => 'required'
        ]);

        $exam = Exam::where(
            'exam_code',
            strtoupper($request->exam_code)
        )
            ->where(
                'status',
                'published'
            )
            ->first();

        if (!$exam) {

            return back()->with(
                'error',
                'Invalid or unavailable exam code.'
            );
        }

        $existingAttempt = ExamAttempt::where(
            'exam_id',
            $exam->id
        )
            ->where(
                'student_id',
                auth()->id()
            )
            ->whereNotNull('submitted_at')
            ->first();

        /*
        ------------------------------------------------
        Already Taken
        ------------------------------------------------
        */

        if ($existingAttempt) {

            return redirect()->route(
                'student.exam.result',
                $existingAttempt->id
            );
        }

        return view(
            'student.exam.instructions',
            compact('exam')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Start Exam
    |--------------------------------------------------------------------------
    */
    public function beginExam(Request $request)
    {
        $exam = Exam::findOrFail(
            $request->exam_id
        );

        $existingAttempt = ExamAttempt::where(
            'exam_id',
            $exam->id
        )
            ->where(
                'student_id',
                auth()->id()
            )
            ->whereNotNull('submitted_at')
            ->first();

        if ($existingAttempt) {

            return redirect()->route(
                'student.exam.result',
                $existingAttempt->id
            );
        }

        $attempt = ExamAttempt::create([

            'exam_id' => $exam->id,

            'student_id' => auth()->id(),

            'started_at' => now(),

            'status' => 'ongoing',

        ]);

        return redirect()->route(
            'student.exam.take',
            $attempt->id
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Take Exam
    |--------------------------------------------------------------------------
    */
    public function takeExam(
        ExamAttempt $attempt
    ) {
        $attempt->load(
            'exam.questions.options'
        );

        return view(
            'student.exam.take',
            compact('attempt')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Submit Exam
    |--------------------------------------------------------------------------
    */
    public function submitExam(
        Request $request,
        ExamAttempt $attempt
    ) {
        $attempt->load(
            'exam.questions.options'
        );

        $score = 0;

        $totalScore = 0;

        foreach (
            $attempt->exam->questions
            as $question
        ) {

            $studentAnswer =
                $request->answers[$question->id]
                ?? '';

            $isCorrect = false;

            /*
            --------------------------------
            MCQ
            --------------------------------
            */

            if (
                $question->question_type
                == 'mcq'
            ) {

                $isCorrect =
                    trim($studentAnswer)
                    ==
                    trim(
                        $question->correct_answer
                    );
            }

            /*
            --------------------------------
            TRUE / FALSE
            --------------------------------
            */ elseif (
                $question->question_type
                == 'tf'
            ) {

                $isCorrect =
                    strtolower(
                        trim($studentAnswer)
                    )
                    ==
                    strtolower(
                        trim(
                            $question->correct_answer
                        )
                    );
            }

            /*
            --------------------------------
            IDENTIFICATION
            --------------------------------
            */ elseif (
                $question->question_type
                ==
                'identification'
            ) {

                $isCorrect =
                    strtolower(
                        trim($studentAnswer)
                    )
                    ==
                    strtolower(
                        trim(
                            $question->correct_answer
                        )
                    );
            }

            /*
            --------------------------------
            Save Answer
            --------------------------------
            */

            Answer::create([

                'attempt_id'
                => $attempt->id,

                'question_id'
                => $question->id,

                'answer_text'
                => $studentAnswer,

                'is_correct'
                => $isCorrect,

            ]);

            $totalScore +=
                $question->points;

            if ($isCorrect) {

                $score +=
                    $question->points;
            }
        }

        /*
        --------------------------------
        Update Attempt
        --------------------------------
        */

        $attempt->update([

            'score'
            => $score,

            'total_score'
            => $totalScore,

            'submitted_at'
            => now(),

            'status'
            => 'completed',

        ]);

        return redirect()->route(
            'student.exam.result',
            $attempt->id
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Result Page
    |--------------------------------------------------------------------------
    */
    public function result(
        ExamAttempt $attempt
    ) {
        $attempt->load(
            'exam'
        );

        return view(
            'student.exam.result',
            compact('attempt')
        );
    }
}
