<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\ExamController;
use App\Http\Controllers\Teacher\QuestionController;

Route::middleware(['auth', 'role:teacher'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/teacher/dashboard', function () {

        return view('teacher.dashboard');
    })->name('teacher.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Exams
    |--------------------------------------------------------------------------
    */

    Route::resource('teacher/exams', ExamController::class)->names([
        'index' => 'teacher.exams.index',
        'create' => 'teacher.exams.create',
        'store' => 'teacher.exams.store',
        'show' => 'teacher.exams.show',
        'edit' => 'teacher.exams.edit',
        'update' => 'teacher.exams.update',
        'destroy' => 'teacher.exams.destroy',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Question Builder
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/teacher/exams/{exam}/questions',
        [QuestionController::class, 'index']
    )->name('teacher.exams.questions');

    Route::get(
        '/teacher/exams/{exam}/questions/create',
        [QuestionController::class, 'create']
    )->name('teacher.questions.create');

    Route::post(
        '/teacher/exams/{exam}/questions',
        [QuestionController::class, 'store']
    )->name('teacher.questions.store');

    /*
    |--------------------------------------------------------------------------
    | Question CRUD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/teacher/questions/{question}/edit',
        [QuestionController::class, 'edit']
    )->name('teacher.questions.edit');

    Route::put(
        '/teacher/questions/{question}',
        [QuestionController::class, 'update']
    )->name('teacher.questions.update');

    Route::delete(
        '/teacher/questions/{question}',
        [QuestionController::class, 'destroy']
    )->name('teacher.questions.destroy');


    Route::patch(
        '/teacher/exams/{exam}/status',
        [ExamController::class, 'updateStatus']
    )->name('teacher.exams.status');
});
