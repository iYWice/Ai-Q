@extends('layouts.app')

@section('title', 'My Exams')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('teacher.exams.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            Create Exam
        </a>
        
    </div>
    

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif


    @forelse($exams as $exam)


        <div class="bg-white shadow rounded p-5 mb-4">

            <div class="flex justify-between items-center">

                {{-- Exam Info --}}
                <div>
                    <h2 class="text-xl font-semibold">
                        {{ $exam->title }}
                    </h2>

                    <p class="text-gray-600">
                        Code: {{ $exam->exam_code }}
                    </p>
                </div>


                {{-- Status Form --}}
                <form method="POST"
                      action="{{ route('teacher.exams.status', $exam->id) }}">

                    @csrf
                    @method('PATCH')

                    <select name="status"
                            onchange="this.form.submit()"
                            class="border rounded px-3 py-2">

                        <option value="draft"
                            {{ $exam->status == 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                        <option value="published"
                            {{ $exam->status == 'published' ? 'selected' : '' }}>
                            Published
                        </option>

                        <option value="closed"
                            {{ $exam->status == 'closed' ? 'selected' : '' }}>
                            Closed
                        </option>

                    </select>

                </form>

            </div>
                {{-- Status Badge --}}
    {{-- Actions --}}
<div class="mt-5 flex flex-wrap gap-3">

    <a href="{{ route('teacher.exams.show',$exam->id) }}"
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

        View Exam

    </a>

    <a href="{{ route('teacher.exams.questions', $exam->id) }}"
        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">

        Manage Questions

    </a>

    <a href="{{ route('teacher.exams.edit', $exam->id) }}"
        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">

        Edit Exam

    </a>

    <form action="{{ route('teacher.exams.destroy', $exam->id) }}"
          method="POST"
          onsubmit="return confirm('Delete this exam?')">

        @csrf
        @method('DELETE')

        <button
            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">

            Delete Exam

        </button>

    </form>

</div>
        </div>
    @empty

        <div class="bg-white p-5 rounded shadow">
            No exams created yet.
        </div>

    @endforelse

</div>

@endsection