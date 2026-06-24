@extends('layouts.app')

@section('title', 'Teacher Dashboard')

@section('content')

<div class="grid grid-cols-4 gap-4">

    <div class="bg-white p-5 rounded shadow">
        Total Exams
    </div>

    <div class="bg-white p-5 rounded shadow">
        Total Questions
    </div>

    <div class="bg-white p-5 rounded shadow">
        Student Attempts
    </div>

    <div class="bg-white p-5 rounded shadow">
        Average Score
    </div>

</div>

@endsection