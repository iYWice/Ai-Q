<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', function () {
        return view('teacher.dashboard');
    });
});
