@extends('layouts.admin')

@section('title', 'Admin Rooms')

@section('content')
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
        <!-- Sidebar same as dashboard -->
        <div class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg z-50">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800">AKASI Admin</h1>
            </div>
            <nav class="mt-8">
                <a href="/admin" class="block py-2 px-6 text-gray-700 hover:bg-gray-100 font-medium">Dashboard</a>
                <a href="/admin/rooms" class="block py-2 px-6 text-gray-700 bg-gray-100 font-bold">Rooms</a>
                <a href="/rooms" class="block py-2 px-6 text-gray-700 hover:bg-gray-100">User Booking</a>
                <a href="{{ route('logout') }}" class="block py-2 px-6 text-gray-700 hover:bg-gray-100">Logout</a>
            </nav>
        </div>

<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold text-gray-800">Room Management</h2>
        <a href="{{ route('admin.rooms.create') }}" class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-6 py-2 rounded-lg hover:from-emerald-600 hover:to-emerald-700 font-medium shadow-lg hover:shadow-xl transition-all">+ Tambah Kamar</a>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No. Kamar</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga/Malam</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($rooms as $room)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $room->room_number }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 text-sm font-semibold bg-indigo-100 text-indigo-800 rounded-full">
                                {{ $room->roomType->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                @if($room->status == 'available') bg-emerald-100 text-emerald-800 @elseif($room->status == 'booked') bg-amber-100 text-amber-800 @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($room->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-900 font-semibold">Rp {{ number_format($room->roomType->price_per_night, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <button class="text-blue-600 hover:text-blue-900 text-sm font-medium">Edit</button>
                            <button class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4l-8-4M4 7l8 4m0 0l8 4m-8-4v12m0 0L4 20m12 0l8-4M4 20l8 4m8-4v12" />
                            </svg>
                            <p class="mt-2 text-lg font-medium">Belum ada kamar</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

