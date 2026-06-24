@extends('layouts.app')

@section('title','Edit Exam')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">

    <h1 class="text-3xl font-bold mb-6">

        Edit Exam

    </h1>

    <form method="POST"
          action="{{ route('teacher.exams.update',$exam->id) }}">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block mb-2">

                Title

            </label>

            <input
                type="text"
                name="title"
                value="{{ $exam->title }}"
                class="w-full border rounded p-2">

        </div>

        <div class="mb-4">

            <label class="block mb-2">

                Subject

            </label>

            <select
                name="subject_id"
                class="w-full border rounded p-2">

                @foreach($subjects as $subject)

                    <option
                        value="{{ $subject->id }}"
                        {{ $exam->subject_id==$subject->id ? 'selected':'' }}>

                        {{ $subject->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block mb-2">

                Class

            </label>

            <select
                name="class_id"
                class="w-full border rounded p-2">

                @foreach($classes as $class)

                    <option
                        value="{{ $class->id }}"
                        {{ $exam->class_id==$class->id ? 'selected':'' }}>

                        {{ $class->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block mb-2">

                Duration (minutes)

            </label>

            <input
                type="number"
                name="duration"
                value="{{ $exam->duration }}"
                class="w-full border rounded p-2">

        </div>

        <div class="mb-6">

            <label class="block mb-2">

                Passing Score

            </label>

            <input
                type="number"
                name="passing_score"
                value="{{ $exam->passing_score }}"
                class="w-full border rounded p-2">

        </div>

        <button
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

            Save Changes

        </button>

    </form>

</div>

@endsection