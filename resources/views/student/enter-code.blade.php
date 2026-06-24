<h1>Enter Exam Code</h1>

<form method="POST" action="/student/exam/start">
    @csrf

    <input type="text"
           name="exam_code"
           placeholder="Enter exam code">

    @error('exam_code')
        <p>{{ $message }}</p>
    @enderror

    <button type="submit">
        Start Exam
    </button>
</form>