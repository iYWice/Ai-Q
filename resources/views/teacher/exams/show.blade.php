@extends('layouts.app')

@section('content')

<h1>{{ $exam->title }}</h1>

<p>
Code: {{ $exam->exam_code }}
</p>

<p>
Status: {{ ucfirst($exam->status) }}
</p>

<p>
Total Questions:
{{ $exam->questions->count() }}
</p>

<a href="/teacher/exams/{{ $exam->id }}/questions/create"
   class="btn btn-primary">
   Add Question
</a>

<hr>

@foreach($exam->questions as $question)

<div class="card mb-3">

    <div class="card-body">

        <strong>
            {{ $question->question_text }}
        </strong>

        <br>

        Type:
        {{ ucfirst($question->question_type) }}

    </div>

</div>

@endforeach

@endsection