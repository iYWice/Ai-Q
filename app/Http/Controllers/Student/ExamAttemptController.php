<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use App\Models\ExamAnswer;
use App\Models\Question;


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

    public function startExam(Request $request)
    {
        $exam = Exam::where('exam_code', $request->exam_code)
            ->where('status', 'published')
            ->first();

        if (!$exam) {
            return back()->withErrors(['Invalid exam code']);
        }

        $attempt = ExamAttempt::create([
            'exam_id' => $exam->id,
            'student_id' => auth()->id(),
            'started_at' => now(),
        ]);

        $questions = $exam->questions()->with('options')->get();

        return view('student.exam.take', compact('exam', 'attempt', 'questions'));
    }
    public function takeExam(ExamAttempt $attempt)
    {
        $attempt->load(

            'exam.questions.options'

        );

        return view(

            'student.exam.take',

            compact('attempt')

        );
    }
    public function submitExam(Request $request, $attemptId)
    {
        $attempt = ExamAttempt::findOrFail($attemptId);

        $questions = $attempt->exam->questions;

        $score = 0;

        $total = 0;

        foreach ($questions as $question) {

            $studentAnswer =
                $request->answers[$question->id] ?? '';

            $correct = false;

            if ($question->question_type == 'mcq') {

                $correct =
                    $studentAnswer ==
                    $question->correct_answer;
            } elseif ($question->question_type == 'tf') {

                $correct =
                    strtolower(trim($studentAnswer))
                    ==
                    strtolower(trim($question->correct_answer));
            } else {

                $correct =
                    strtolower(trim($studentAnswer))
                    ==
                    strtolower(trim($question->correct_answer));
            }

            Answer::create([

                'attempt_id' => $attempt->id,

                'question_id' => $question->id,

                'answer_text' => $studentAnswer,

                'is_correct' => $correct,

            ]);

            $total += $question->points;

            if ($correct) {

                $score += $question->points;
            }
        }

        $attempt->update([

            'score' => $score,

            'total_score' => $total,

            'submitted_at' => now(),

            'status' => 'completed',

        ]);

        return redirect()

            ->route('student.exam.result', $attempt->id)

            ->with('success', 'Exam submitted successfully.');
    }
    public function beginExam(Request $request)
    {
        $exam = Exam::findOrFail(
            $request->exam_id
        );

        $attempt = ExamAttempt::create([

            'exam_id' => $exam->id,

            'student_id' => auth()->id(),

            'started_at' => now(),

        ]);

        return redirect(

            "/student/exam/{$attempt->id}/take"

        );
    }
    public function result($attemptId)
    {
        $attempt = ExamAttempt::with('exam')

            ->findOrFail($attemptId);

        return view(

            'student.exam.result',

            compact('attempt')

        );
    }
}
