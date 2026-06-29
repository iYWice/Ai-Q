<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ai-Q</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 text-white">

            <div class="p-5 border-b border-slate-700">
                <h1 class="text-xl font-bold">
                    Ai-Q
                </h1>
            </div>

            <nav class="p-4 space-y-2">

                {{-- Teacher Menu --}}
                @if(auth()->user()->role === 'teacher')

                    <a href="/teacher/dashboard"
                       class="block px-3 py-2 rounded hover:bg-slate-700">
                        Dashboard
                    </a>

                    <a href="/teacher/exams"
                       class="block px-3 py-2 rounded hover:bg-slate-700">
                        My Exams
                    </a>

                @endif


                {{-- Student Menu --}}
                @if(auth()->user()->role === 'student')

                    <a href="/student/dashboard"
                       class="block px-3 py-2 rounded hover:bg-slate-700">
                        Dashboard
                    </a>


                @endif

            </nav>

        </aside>


        {{-- Main Content --}}
        <main class="flex-1">

            {{-- Topbar --}}
            <header class="bg-white shadow px-6 py-4 flex justify-between">

                <h2 class="font-semibold text-lg">
                    @yield('title')
                </h2>

                <div class="flex items-center gap-4">

                    <span>
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded">
                            Logout
                        </button>
                    </form>

                </div>

            </header>


            {{-- Page Content --}}
            <section class="p-6">
                @yield('content')
            </section>

        </main>

    </div>

</body>
</html>