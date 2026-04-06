<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'CHADS Coffee Hotel Akasi') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Figtree', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-emerald-50 to-green-50">
        <!-- Logo -->
        <div class="mb-8">
            <a href="/">
                <div class="mx-auto h-20 w-20 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl mb-4 hover:scale-110 transition-transform">
                    <i class="fas fa-coffee text-3xl text-white"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-black bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 bg-clip-text text-transparent text-center">
                    CHADS Coffee Hotel
                </h1>
            </a>
        </div>

        <!-- Main Content -->
        <div class="w-full sm:max-w-2xl mt-6 px-6 py-8 sm:p-12 bg-white/80 backdrop-blur-xl shadow-2xl overflow-hidden sm:rounded-3xl border border-emerald-100/50">
            {{ $slot }}
        </div>
    </div>
</body>
</html>

