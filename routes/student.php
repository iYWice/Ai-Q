<?php

use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\ExamAttemptController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    });

    Route::get(

        '/student/dashboard',

        [DashboardController::class, 'index']

    )->name('student.dashboard');

    Route::post(
        '/student/exam/begin',
        [ExamAttemptController::class, 'beginExam']
    );

    Route::get('/student/exam', [ExamAttemptController::class, 'showCodeForm']);

    Route::post('/student/exam/start', [ExamAttemptController::class, 'startExam']);

    Route::get(
        '/student/exam/{attempt}/take',
        [ExamAttemptController::class, 'takeExam']
    )->name('student.exam.take');

    Route::post(
        '/student/exam/{attempt}/submit',
        [ExamAttemptController::class, 'submitExam']
    );

    Route::get(

        '/student/exam/{attempt}/result',

        [ExamAttemptController::class, 'result']

    )->name('student.exam.result');
    Route::get(
        '/student/exam/{attempt}/result',
        [
            ExamAttemptController::class,
            'result'
        ]
    )->name('student.exam.result');
});
