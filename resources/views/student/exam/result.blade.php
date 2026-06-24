@extends('layouts.app')

@section('title','Exam Result')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white shadow rounded p-8 text-center">

        <h1 class="text-3xl font-bold mb-6">

            Exam Completed

        </h1>

        <div class="text-5xl font-bold text-blue-600">

            {{ $attempt->score }}

            /

            {{ $attempt->total_score }}

        </div>

        <div class="mt-6">

            @php

                $percentage =
                $attempt->total_score > 0

                ? ($attempt->score / $attempt->total_score) * 100

                : 0;

            @endphp

            <h2 class="text-2xl">

                {{ number_format($percentage,1) }}%

            </h2>

        </div>

        <div class="mt-6">

            @if($percentage >= $attempt->exam->passing_score)

                <span class="bg-green-100 text-green-700 px-5 py-2 rounded">

                    PASSED

                </span>

            @else

                <span class="bg-red-100 text-red-700 px-5 py-2 rounded">

                    FAILED

                </span>

            @endif

        </div>

        <div class="mt-8">

            <a href="{{ route('student.dashboard') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded">

                Back to Dashboard

            </a>

        </div>

    </div>

</div>

@endsection