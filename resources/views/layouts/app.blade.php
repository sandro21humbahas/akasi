<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AKASI Hotel') }}</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="antialiased bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-indigo-600">🛏️ AKASI Hotel</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="/dashboard" class="text-gray-700 hover:text-indigo-600">Dashboard</a>
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-indigo-600">Logout</button>
                        </form>
                    @else
                        <a href="/login" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Login</a>
                        <a href="/register" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    @stack('scripts')
    <script> lucide.createIcons(); </script>
</body>
</html>

