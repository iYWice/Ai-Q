@extends('layouts.app')

@section('title','Take Exam')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white shadow rounded p-6">

        <div class="flex justify-between items-center mb-6">

            <div>

                <h1 class="text-3xl font-bold">
                    {{ $attempt->exam->title }}
                </h1>

                <p class="text-gray-500">
                    Answer all questions carefully.
                </p>

            </div>

            <div class="text-right">

                <div class="text-gray-500">
                    Time Remaining
                </div>

                <div
                    id="timer"
                    class="text-2xl font-bold text-red-600">

                    --:--

                </div>

            </div>

        </div>

        <form
            method="POST"
            action="/student/exam/{{ $attempt->id }}/submit">

            @csrf

            @foreach($attempt->exam->questions as $question)

            <div class="bg-gray-50 border rounded p-5 mb-5">

                <div class="flex justify-between mb-3">

                    <h3 class="font-semibold text-lg">

                        Question {{ $loop->iteration }}

                    </h3>

                    <span class="text-sm text-gray-500">

                        {{ $question->points }} point(s)

                    </span>

                </div>

                <p class="mb-4">

                    {{ $question->question_text }}

                </p>

                {{-- Multiple Choice --}}
                @if($question->question_type == 'mcq')

                    @foreach($question->options as $option)

                        <label class="flex items-center gap-2 mb-2 cursor-pointer">

                            <input
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                value="{{ $option->option_text }}">

                            {{ $option->option_text }}

                        </label>

                    @endforeach

                @endif


                {{-- True / False --}}
                @if($question->question_type == 'tf')

                    <label class="flex items-center gap-2 mb-2 cursor-pointer">

                        <input
                            type="radio"
                            name="answers[{{ $question->id }}]"
                            value="True">

                        True

                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">

                        <input
                            type="radio"
                            name="answers[{{ $question->id }}]"
                            value="False">

                        False

                    </label>

                @endif


                {{-- Identification --}}
                @if($question->question_type == 'identification')

                    <input
                        type="text"
                        name="answers[{{ $question->id }}]"
                        class="border rounded p-2 w-full"
                        placeholder="Type your answer">

                @endif

            </div>

            @endforeach


            <button
                type="submit"
                onclick="return confirm('Submit exam?')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded w-full">

                Submit Exam

            </button>

        </form>

    </div>

</div>

<script>

let duration = {{ $attempt->exam->duration ?? 30 }};

let seconds = duration * 60;

function updateTimer() {

    let minutes = Math.floor(seconds / 60);

    let remaining = seconds % 60;

    document.getElementById('timer').innerHTML =

        String(minutes).padStart(2,'0')
        +
        ':'
        +
        String(remaining).padStart(2,'0');

    if(seconds <= 0){

        document.forms[0].submit();

    }

    seconds--;

}

updateTimer();

setInterval(updateTimer,1000);

</script>

@endsection