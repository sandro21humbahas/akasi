<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AKASI Hotel Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <div class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg z-50">
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-gray-800">AKASI Admin</h1>
            </div>
            <nav class="mt-8">
                <a href="/admin" class="block py-3 px-6 {{ request()->is('admin') ? 'bg-gray-100 font-semibold' : 'hover:bg-gray-100' }} text-gray-700">Dashboard</a>
                <a href="/admin/rooms" class="block py-3 px-6 {{ request()->is('admin/rooms*') ? 'bg-gray-100 font-semibold' : 'hover:bg-gray-100' }} text-gray-700">Rooms</a>
                <a href="/rooms" class="block py-3 px-6 hover:bg-gray-100 text-gray-700">User Booking</a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full py-3 px-6 text-left hover:bg-red-50 text-gray-700 border-t">Logout</button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="ml-64 p-8">
            @yield('content')
        </div>
    </div>
</body>
</html>

