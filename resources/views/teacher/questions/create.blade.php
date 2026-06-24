@extends('layouts.app')

@section('title','Question Builder')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white shadow rounded-lg p-8">

        <h1 class="text-3xl font-bold mb-2">

            Question Builder

        </h1>

        <p class="text-gray-500 mb-8">

            Exam: {{ $exam->title }}

        </p>

        @if($errors->any())

            <div class="bg-red-100 border border-red-300 p-4 rounded mb-6">

                <ul class="list-disc ml-5">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form method="POST"
            action="{{ route('teacher.questions.store',$exam->id) }}">

            @csrf

            {{-- Question Type --}}

            <div class="mb-6">

                <label class="block font-semibold mb-2">

                    Question Type

                </label>

                <select
                    id="questionType"
                    name="question_type"
                    class="border rounded w-full p-3">

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

            {{-- Question --}}

            <div class="mb-6">

                <label class="block font-semibold mb-2">

                    Question

                </label>

                <textarea
                    name="question_text"
                    rows="3"
                    class="border rounded w-full p-3"
                    required></textarea>

            </div>

            {{-- MCQ --}}

            <div id="mcqFields">

                <h2 class="font-semibold mb-4">

                    Choices

                </h2>

                <input
                    type="text"
                    name="choice_a"
                    placeholder="Choice A"
                    class="border rounded w-full p-2 mb-3">

                <input
                    type="text"
                    name="choice_b"
                    placeholder="Choice B"
                    class="border rounded w-full p-2 mb-3">

                <input
                    type="text"
                    name="choice_c"
                    placeholder="Choice C"
                    class="border rounded w-full p-2 mb-3">

                <input
                    type="text"
                    name="choice_d"
                    placeholder="Choice D"
                    class="border rounded w-full p-2 mb-6">

                <label class="block font-semibold mb-3">

                    Correct Answer

                </label>

                <div class="space-y-2">

                    <label>

                        <input type="radio"
                            name="correct_answer"
                            value=""
                            id="radioA">

                        Choice A

                    </label>

                    <br>

                    <label>

                        <input type="radio"
                            name="correct_answer"
                            value=""
                            id="radioB">

                        Choice B

                    </label>

                    <br>

                    <label>

                        <input type="radio"
                            name="correct_answer"
                            value=""
                            id="radioC">

                        Choice C

                    </label>

                    <br>

                    <label>

                        <input type="radio"
                            name="correct_answer"
                            value=""
                            id="radioD">

                        Choice D

                    </label>

                </div>

            </div>

            {{-- TRUE FALSE --}}

            <div
                id="tfFields"
                style="display:none;">

                <label class="block font-semibold mb-3">

                    Correct Answer

                </label>

                <label>

                    <input
                        type="radio"
                        name="correct_answer"
                        value="True">

                    True

                </label>

                <br><br>

                <label>

                    <input
                        type="radio"
                        name="correct_answer"
                        value="False">

                    False

                </label>

            </div>

            {{-- Identification --}}

            <div
                id="idFields"
                style="display:none;">

                <label class="block font-semibold mb-2">

                    Correct Answer

                </label>

                <input
                    type="text"
                    name="correct_answer"
                    class="border rounded w-full p-2">

            </div>

            <div class="mt-6">

                <label class="block font-semibold mb-2">

                    Points

                </label>

                <input
                    type="number"
                    name="points"
                    value="1"
                    min="1"
                    class="border rounded w-full p-2">

            </div>

            <button
                class="mt-8 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded">

                Save Question

            </button>

        </form>

    </div>

</div>

<script>

const type =
document.getElementById('questionType');

const mcq =
document.getElementById('mcqFields');

const tf =
document.getElementById('tfFields');

const id =
document.getElementById('idFields');

function updateUI(){

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

type.addEventListener('change',updateUI);

updateUI();

document.querySelector('input[name=choice_a]')?.addEventListener('input',e=>{
document.getElementById('radioA').value=e.target.value;
});

document.querySelector('input[name=choice_b]')?.addEventListener('input',e=>{
document.getElementById('radioB').value=e.target.value;
});

document.querySelector('input[name=choice_c]')?.addEventListener('input',e=>{
document.getElementById('radioC').value=e.target.value;
});

document.querySelector('input[name=choice_d]')?.addEventListener('input',e=>{
document.getElementById('radioD').value=e.target.value;
});

</script>

@endsection