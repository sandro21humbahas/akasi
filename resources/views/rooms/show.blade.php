@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-8">
        @if($roomType->base_image)
            <img src="{{ $roomType->base_image }}" alt="{{ $roomType->name }}" class="w-full h-96 object-cover">
        @else
            <div class="w-full h-96 bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                <i class="fas fa-hotel text-white text-8xl opacity-75"></i>
            </div>
        @endif
        <div class="p-12">
            <div class="flex items-start justify-between mb-8">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $roomType->name }}</h1>
                    <p class="text-xl text-gray-600">{{ $roomType->description }}</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold text-indigo-600 mb-1">
                        Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }} /night
                    </div>
                    <div class="text-lg text-gray-500">{{ $checkOut->diffInDays($checkIn) }} nights</div>
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <div>
                    <h3 class="text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-calendar-day mr-2 text-indigo-600"></i> Dates
                    </h3>
                    <form method="GET" action="{{ route('rooms.show', $roomType) }}" class="space-y-4">
                        <input type="date" name="check_in" value="{{ $checkIn->format('Y-m-d') }}" 
                               class="w-full p-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                        <input type="date" name="check_out" value="{{ $checkOut->format('Y-m-d') }}" 
                               class="w-full p-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                        <button type="submit" class="w-full bg-indigo-600 text-white py-4 px-8 rounded-xl font-semibold hover:bg-indigo-700 transition-all">
                            Check Availability
                        </button>
                    </form>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-indigo-600"></i> Summary
                    </h3>
                    <div class="bg-gray-50 p-6 rounded-2xl">
                        <div class="text-2xl font-bold text-indigo-600 mb-4">
                            Total: Rp {{ number_format($totalPrice, 0, ',', '.') }}
                        </div>
                        <div class="space-y-2 text-sm">
                            <div>{{ $checkIn->format('d M Y') }} - {{ $checkOut->format('d M Y') }}</div>
                            <div>{{ $checkOut->diffInDays($checkIn) }} nights × Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($availableRooms->isEmpty())
        <div class="text-center py-16 bg-white rounded-2xl shadow-lg">
            <i class="fas fa-calendar-times text-6xl text-red-400 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">No Rooms Available</h3>
            <p class="text-gray-600 mb-6">Sorry, no rooms of this type are available for your selected dates.</p>
            <a href="{{ route('rooms.index') }}" class="bg-indigo-600 text-white py-3 px-8 rounded-xl font-semibold hover:bg-indigo-700">
                Browse All Rooms
            </a>
        </div>
    @else
        <div class="space-y-6">
            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-door-open mr-3 text-indigo-600"></i>
                {{ $availableRooms->count() }} Available Room{{ $availableRooms->count() > 1 ? 's' : '' }}
            </h2>
            
            @foreach($availableRooms as $room)
                <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-24 h-24 bg-indigo-100 rounded-xl flex items-center justify-center mr-6">
                            <i class="fas fa-door-open text-3xl text-indigo-600"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Room {{ $room->room_number }}</h3>
                            <p class="text-gray-600">Perfect for your stay</p>
                        </div>
                    </div>
                    @auth
                        <form method="POST" action="{{ route('bookings.store') }}" class="inline">
                            @csrf
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            <input type="hidden" name="check_in" value="{{ $checkIn->format('Y-m-d') }}">
                            <input type="hidden" name="check_out" value="{{ $checkOut->format('Y-m-d') }}">
                            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                            <button type="submit" class="bg-green-600 text-white py-4 px-10 rounded-xl font-bold hover:bg-green-700 transition-colors">
                                <i class="fas fa-lock mr-2"></i> Book Now - Rp {{ number_format($totalPrice, 0, ',', '.') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-indigo-600 text-white py-4 px-10 rounded-xl font-bold hover:bg-indigo-700">
                            Login to Book
                        </a>
                    @endauth
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

