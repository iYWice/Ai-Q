@extends('layouts.app')

@section('title','Exam Instructions')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white shadow rounded p-8">

        <h1 class="text-3xl font-bold mb-2">

            {{ $exam->title }}

        </h1>

        <p class="text-gray-500 mb-8">

            Please read the instructions carefully before starting.

        </p>

        <div class="grid grid-cols-2 gap-4 mb-8">

            <div class="border rounded p-4">

                <div class="text-gray-500">

                    Exam Code

                </div>

                <div class="text-2xl font-bold">

                    {{ $exam->exam_code }}

                </div>

            </div>

            <div class="border rounded p-4">

                <div class="text-gray-500">

                    Total Questions

                </div>

                <div class="text-2xl font-bold">

                    {{ $exam->questions()->count() }}

                </div>

            </div>

            <div class="border rounded p-4">

                <div class="text-gray-500">

                    Passing Score

                </div>

                <div class="text-2xl font-bold">

                    {{ $exam->passing_score }}

                </div>

            </div>

            <div class="border rounded p-4">

                <div class="text-gray-500">

                    Duration

                </div>

                <div class="text-2xl font-bold">

                    {{ $exam->duration ?? 'No Limit' }}

                    mins

                </div>

            </div>

        </div>

        <div class="bg-yellow-50 border border-yellow-300 rounded p-5 mb-6">

            <h3 class="font-bold mb-3">

                Instructions

            </h3>

            <ul class="list-disc ml-6 space-y-2">

                <li>
                    Read every question carefully.
                </li>

                <li>
                    Choose only one answer.
                </li>

                <li>
                    Once submitted, answers cannot be changed.
                </li>

                <li>
                    Your score will be checked automatically.
                </li>

                <li>
                    AI will analyze your performance after the exam.
                </li>

            </ul>

        </div>

        <form
            method="POST"
            action="{{ url('/student/exam/begin') }}">

            @csrf

            <input
                type="hidden"
                name="exam_id"
                value="{{ $exam->id }}">

            <label class="flex items-center mb-6">

                <input
                    type="checkbox"
                    required
                    class="mr-3">

                I have read and understood the instructions.

            </label>

            <button
                class="bg-blue-600 text-white px-8 py-3 rounded w-full">

                Start Exam

            </button>

        </form>

    </div>

</div>

@endsection