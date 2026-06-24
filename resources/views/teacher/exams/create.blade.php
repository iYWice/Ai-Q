<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Exam</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md border border-gray-100">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Create Exam</h1>

        <form method="POST" action="/teacher/exams" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Exam Title</label>
                <input type="text" name="title" placeholder="Exam Title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                <select name="subject_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                <select name="class_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Duration (minutes)</label>
                <input type="number" name="duration" placeholder="Duration in minutes" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Passing Score</label>
                <input type="number" name="passing_score" placeholder="Passing Score" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <button type="submit" class="w-full mt-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition dynamic-shadow cursor-pointer text-center">
                Create Exam
            </button>
        </form>
    </div>

</body>
</html>

{{-- <h1>Create Exam</h1>

<form method="POST" action="/teacher/exams">
    @csrf

    <input type="text" name="title" placeholder="Exam Title">

    <select name="subject_id">
        @foreach($subjects as $subject)
            <option value="{{ $subject->id }}">
                {{ $subject->name }}
            </option>
        @endforeach
    </select>

    <select name="class_id">
        @foreach($classes as $class)
            <option value="{{ $class->id }}">
                {{ $class->name }}
            </option>
        @endforeach
    </select>

    <input type="number" name="duration" placeholder="Duration in minutes">

    <input type="number" name="passing_score" placeholder="Passing Score">

    <button type="submit">Create Exam</button>
</form> --}}