@extends('layouts.app')

@section('title','Question Builder')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-3xl font-bold">

                {{ $exam->title }}

            </h1>

            <p class="text-gray-500">

                Question Builder

            </p>

        </div>

        <a href="{{ route('teacher.exams.index') }}"
            class="bg-gray-600 text-white px-4 py-2 rounded">

            Back

        </a>

    </div>

    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">

            {{ session('success') }}

        </div>

    @endif

    <div class="grid grid-cols-3 gap-4 mb-6">

        <div class="bg-white shadow rounded p-4">

            <div class="text-gray-500">

                Total Questions

            </div>

            <div class="text-3xl font-bold">

                {{ $totalQuestions }}

            </div>

        </div>

        <div class="bg-white shadow rounded p-4">

            <div class="text-gray-500">

                Total Points

            </div>

            <div class="text-3xl font-bold">

                {{ $totalPoints }}

            </div>

        </div>

        <div class="bg-white shadow rounded p-4">

            <div class="text-gray-500">

                Exam Code

            </div>

            <div class="text-2xl font-bold">

                {{ $exam->exam_code }}

            </div>

        </div>

    </div>

    <div class="grid lg:grid-cols-2 gap-6">

        <div class="bg-white shadow rounded p-6">

            <h2 class="text-xl font-bold mb-4">

                Add Question

            </h2>

            <form method="POST"
                action="{{ route('teacher.questions.store',$exam->id) }}">

                @csrf

                <div class="mb-4">

                    <label class="font-semibold">

                        Question Type

                    </label>

                    <select
                        name="question_type"
                        id="questionType"
                        class="border rounded p-2 w-full">

                        <option value="mcq">

                            Multiple Choice

                        </option>

                        <option value="tf">

                            True / False

                        </option>

                        <option value="identification">

                            Identification

                        </option>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="font-semibold">

                        Question

                    </label>

                    <textarea
                        name="question_text"
                        class="border rounded p-2 w-full"
                        rows="3"
                        required></textarea>

                </div>

                <div id="mcqSection">

                    <label class="font-semibold">

                        Choices

                    </label>

                    <input class="border rounded p-2 w-full mb-2"
                        name="options[]"
                        placeholder="Choice A">

                    <input class="border rounded p-2 w-full mb-2"
                        name="options[]"
                        placeholder="Choice B">

                    <input class="border rounded p-2 w-full mb-2"
                        name="options[]"
                        placeholder="Choice C">

                    <input class="border rounded p-2 w-full mb-3"
                        name="options[]"
                        placeholder="Choice D">

                    <label class="font-semibold">

                        Correct Option

                    </label>

                    <select
                        name="correct_option"
                        class="border rounded p-2 w-full">

                        <option value="0">

                            Choice A

                        </option>

                        <option value="1">

                            Choice B

                        </option>

                        <option value="2">

                            Choice C

                        </option>

                        <option value="3">

                            Choice D

                        </option>

                    </select>

                </div>

                <div id="tfSection"
                    style="display:none;">

                    <label class="font-semibold block mb-2">

                        Correct Answer

                    </label>

                    <label>

                        <input
                            type="radio"
                            name="correct_answer"
                            value="True">

                        True

                    </label>

                    <br>

                    <label>

                        <input
                            type="radio"
                            name="correct_answer"
                            value="False">

                        False

                    </label>

                </div>

                <div id="idSection"
                    style="display:none;">

                    <label class="font-semibold block">

                        Correct Answer

                    </label>

                    <input
                        type="text"
                        name="identification_answer"
                        class="border rounded p-2 w-full">

                </div>

                <div class="mt-4">

                    <label>

                        Points

                    </label>

                    <input
                        type="number"
                        name="points"
                        value="1"
                        min="1"
                        class="border rounded p-2 w-full">

                </div>

                <button
                    class="bg-blue-600 text-white px-5 py-2 rounded mt-5 w-full">

                    Add Question

                </button>

            </form>

        </div>

        <div class="bg-white shadow rounded p-6">

            <h2 class="text-xl font-bold mb-4">

                Question Bank

            </h2>

            @forelse($questions as $question)

                <div class="border rounded p-4 mb-3">

                    <div class="font-semibold">

                        {{ $question->question_text }}

                    </div>

                    <div class="text-sm text-gray-500">

                        {{ strtoupper($question->question_type) }}

                    </div>

                    <div>

                        Answer:

                        <strong>

                            {{ $question->correct_answer }}

                        </strong>

                    </div>

                    <div>

                        {{ $question->points }} point(s)

                    </div>

                    <div class="flex gap-2 mt-3">

                        <a
                            href="{{ route('teacher.questions.edit',$question->id) }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded">

                            Edit

                        </a>

                        <form
                            method="POST"
                            action="{{ route('teacher.questions.destroy',$question->id) }}">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Delete question?')"
                                class="bg-red-600 text-white px-3 py-1 rounded">

                                Delete

                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="text-gray-500 text-center py-10">

                    No questions yet.

                </div>

            @endforelse

        </div>

    </div>

</div>

<script>

const type=document.getElementById('questionType');

const mcq=document.getElementById('mcqSection');

const tf=document.getElementById('tfSection');

const id=document.getElementById('idSection');

function changeType(){

    mcq.style.display='none';

    tf.style.display='none';

    id.style.display='none';

    if(type.value==='mcq')
        mcq.style.display='block';

    if(type.value==='tf')
        tf.style.display='block';

    if(type.value==='identification')
        id.style.display='block';

}

type.addEventListener('change',changeType);

changeType();

</script>

@endsection



