@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800">Admin Dashboard</h2>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
        <div class="text-4xl font-bold text-blue-600">{{ $stats['total_bookings'] }}</div>
        <div class="text-gray-600 mt-2">Total Bookings</div>
    </div>
    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
        <div class="text-4xl font-bold text-amber-600">{{ $stats['pending_bookings'] }}</div>
        <div class="text-gray-600 mt-2">Pending</div>
    </div>
    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
        <div class="text-4xl font-bold text-emerald-600">{{ $stats['confirmed_bookings'] }}</div>
        <div class="text-gray-600 mt-2">Confirmed</div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-2xl font-semibold text-gray-800">Recent Bookings</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Guest</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Room</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Dates</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($recent_bookings as $booking)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $booking->user->name }}</td>
                    <td class="px-6 py-4">
                        <div>{{ $booking->room->room_number }}</div>
                        <div class="text-sm text-gray-500">{{ $booking->room->roomType->name }}</div>
                    </td>
                    <td class="px-6 py-4">{{ $booking->check_in->format('d M') }} - {{ $booking->check_out->format('d M') }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                            @if($booking->status == 'confirmed') bg-emerald-100 text-emerald-800 @elseif($booking->status == 'pending') bg-amber-100 text-amber-800 @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <div class="text-2xl">📭</div>
                        <div>No bookings yet</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <div class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg z-50">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800">AKASI Admin</h1>
            </div>
            <nav class="mt-8">
                <a href="/admin" class="block py-2 px-6 text-gray-700 hover:bg-gray-100 font-medium">Dashboard</a>
                <a href="/admin/rooms" class="block py-2 px-6 text-gray-700 hover:bg-gray-100">Rooms</a>
                <a href="/rooms" class="block py-2 px-6 text-gray-700 hover:bg-gray-100">User Booking</a>
                <a href="{{ route('logout') }}" class="block py-2 px-6 text-gray-700 hover:bg-gray-100">Logout</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="ml-64 p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Admin Dashboard</h2>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-3xl font-bold text-blue-600">{{ $stats['total_bookings'] }}</div>
                    <div class="text-gray-600">Total Bookings</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-3xl font-bold text-yellow-600">{{ $stats['pending_bookings'] }}</div>
                    <div class="text-gray-600">Pending</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-3xl font-bold text-green-600">{{ $stats['confirmed_bookings'] }}</div>
                    <div class="text-gray-600">Confirmed</div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="text-xl font-semibold">Recent Bookings</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Guest</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Room</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dates</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($recent_bookings as $booking)
                            <tr>
                                <td class="px-6 py-4">{{ $booking->user->name }}</td>
                                <td class="px-6 py-4">{{ $booking->room->room_number }} ({{ $booking->room->roomType->name }})</td>
                                <td class="px-6 py-4">{{ $booking->check_in->format('d/M') }} - {{ $booking->check_out->format('d/M') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full @if($booking->status == 'confirmed') bg-green-100 text-green-800 @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800 @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-medium">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No bookings yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

