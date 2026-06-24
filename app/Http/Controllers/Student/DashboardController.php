<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamAttempt;

class DashboardController extends Controller
{
    public function index()
    {
        $attempts = ExamAttempt::with('exam')

            ->where('student_id', auth()->id())

            ->latest()

            ->get();

        $averageScore = round(

            $attempts->avg('score') ?? 0

        );

        $passed = $attempts

            ->filter(function ($attempt) {

                return ($attempt->score ?? 0)

                    >= $attempt->exam->passing_score;
            })

            ->count();

        return view(

            'student.dashboard',

            compact(

                'attempts',

                'averageScore',

                'passed'

            )

        );
    }
}
