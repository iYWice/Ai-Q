@extends('layouts.app')

@section('title','Student Dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="mb-8">

        <h1 class="text-3xl font-bold">

            Welcome,

            {{ auth()->user()->name }}

        </h1>

        <p class="text-gray-500">

            Take exams and monitor your performance.

        </p>

    </div>

    {{-- Statistics --}}

    <div class="grid md:grid-cols-3 gap-5 mb-8">

        <div class="bg-white shadow rounded p-5">

            <div class="text-gray-500">

                Exams Taken

            </div>

            <div class="text-4xl font-bold">

                {{ $attempts->count() }}

            </div>

        </div>

        <div class="bg-white shadow rounded p-5">

            <div class="text-gray-500">

                Average Score

            </div>

            <div class="text-4xl font-bold">

                {{ $averageScore }}%

            </div>

        </div>

        <div class="bg-white shadow rounded p-5">

            <div class="text-gray-500">

                Passed

            </div>

            <div class="text-4xl font-bold">

                {{ $passed }}

            </div>

        </div>

    </div>

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- Enter Exam Code --}}

        <div class="lg:col-span-1">

            <div class="bg-white shadow rounded p-6">

                <h2 class="text-xl font-bold mb-4">

                    Take New Exam

                </h2>

                @if(session('error'))

                    <div class="bg-red-100 text-red-700 p-3 rounded mb-3">

                        {{ session('error') }}

                    </div>

                @endif

                <form method="POST"

                    action="{{ url('/student/exam/start') }}">

                    @csrf

                    <input

                        type="text"

                        name="exam_code"

                        placeholder="Enter Exam Code"

                        class="border rounded p-3 w-full uppercase"

                        required>

                    <button

                        class="bg-blue-600 text-white w-full mt-4 py-3 rounded">

                        Start Exam

                    </button>

                </form>

            </div>

        </div>

        {{-- Recent Exams --}}

        <div class="lg:col-span-2">

            <div class="bg-white shadow rounded p-6">

                <h2 class="text-xl font-bold mb-5">

                    Recent Exams

                </h2>

                @forelse($attempts as $attempt)

                    <div class="border-b py-4 flex justify-between">

                        <div>

                            <div class="font-semibold">

                                {{ $attempt->exam->title }}

                            </div>

                            <div class="text-gray-500 text-sm">

                                {{ $attempt->created_at->format('M d, Y') }}

                            </div>

                        </div>

                        <div class="text-right">

                            <div class="font-bold">

                                {{ $attempt->score ?? 0 }}

                            </div>

                            <div>

                                @if(($attempt->score ?? 0) >= $attempt->exam->passing_score)

                                    <span class="text-green-600">

                                        PASSED

                                    </span>

                                @else

                                    <span class="text-red-600">

                                        FAILED

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-gray-500 text-center py-10">

                        No exams taken yet.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection