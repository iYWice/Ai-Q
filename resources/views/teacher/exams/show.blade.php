@extends('layouts.app')

@section('title','Exam Details')

@section('content')

<div class="max-w-6xl mx-auto">

    <h1 class="text-3xl font-bold mb-2">

        {{ $exam->title }}

    </h1>

    <p class="text-gray-500 mb-6">

        Exam Code:
        {{ $exam->exam_code }}

    </p>

    <div
        class="bg-white shadow rounded p-6">

        <h2
            class="text-2xl font-bold mb-5">

            Student Attempts

        </h2>

        @forelse(
            $exam->attempts
            as $attempt
        )

            <div
                class="border-b py-4 flex justify-between">

                <div>

                    <div
                        class="font-semibold">

                        {{ $attempt->student->name }}

                    </div>

                    <div
                        class="text-gray-500 text-sm">

                        Started:

                        {{ $attempt->started_at }}

                    </div>

                </div>

                <div
                    class="text-right">

                    @if(
                        $attempt->status
                        == 'ongoing'
                    )

                        <span
                            class="bg-yellow-100
                            text-yellow-700
                            px-3 py-1 rounded">

                            Taking Exam

                        </span>

                    @endif

                    @if(
                        $attempt->status
                        == 'completed'
                    )

                        <div>

                            <span
                                class="bg-green-100
                                text-green-700
                                px-3 py-1 rounded">

                                Completed

                            </span>

                        </div>

                        <div
                            class="mt-2">

                            Score:

                            <strong>

                                {{ $attempt->score }}

                                /

                                {{ $attempt->total_score }}

                            </strong>

                        </div>

                    @endif

                </div>

            </div>

        @empty

            <div
                class="text-gray-500">

                No students have
                taken this exam yet.

            </div>

        @endforelse

    </div>

</div>

@endsection