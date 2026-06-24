@extends('layouts.app')

@section('title','Edit Question')

@section('content')

<div class="max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">

        Edit Question

    </h1>

    @if(session('success'))

        <div class="bg-green-100 p-3 rounded mb-4">

            {{ session('success') }}

        </div>

    @endif

    <form method="POST"
          action="{{ route('teacher.questions.update',$question->id) }}"
          class="bg-white shadow rounded p-6">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label>Question</label>

            <textarea
                name="question_text"
                class="w-full border rounded p-2"
                rows="3">{{ $question->question_text }}</textarea>

        </div>

        @if($question->type === 'multiple_choice')

            @php
                $choices = json_decode($question->choices,true);
            @endphp

            <input type="text"
                   name="choice_a"
                   value="{{ $choices[0] ?? '' }}"
                   class="w-full border rounded p-2 mb-2">

            <input type="text"
                   name="choice_b"
                   value="{{ $choices[1] ?? '' }}"
                   class="w-full border rounded p-2 mb-2">

            <input type="text"
                   name="choice_c"
                   value="{{ $choices[2] ?? '' }}"
                   class="w-full border rounded p-2 mb-2">

            <input type="text"
                   name="choice_d"
                   value="{{ $choices[3] ?? '' }}"
                   class="w-full border rounded p-2 mb-4">

        @endif

{{-- Correct Answer --}}

@if(in_array($question->type, ['tf', 'tf'], true))

    <div class="mb-4">
        <label class="block font-semibold mb-2">Correct Answer</label>
        <div class="flex gap-8">
            <label class="flex items-center gap-2">
                <input
                    type="radio"
                    name="correct_answer"
                    value="True"
                    {{ $question->correct_answer == 'True' ? 'checked' : '' }}>
                <span>True</span>
            </label>
            <label class="flex items-center gap-2">
                <input
                    type="radio"
                    name="correct_answer"
                    value="False"
                    {{ $question->correct_answer == 'False' ? 'checked' : '' }}>
                <span>False</span>
            </label>
        </div>
    </div>

@else

    <div class="mb-4">
        <label class="block font-semibold mb-2">Correct Answer</label>
        <input
            type="text"
            name="correct_answer"
            value="{{ $question->correct_answer }}"
            class="w-full border rounded p-2">
    </div>

@endif

        <div class="mb-4">

            <label>Points</label>

            <input
                type="number"
                name="points"
                value="{{ $question->points }}"
                class="w-full border rounded p-2">

        </div>

        <button
            class="bg-blue-600 text-white px-5 py-2 rounded">

            Save Changes

        </button>

    </form>

</div>

@endsection