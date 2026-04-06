@extends('layouts.app')

@section('content')
<div class="text-center py-16">
    <h1 class="text-5xl font-bold text-gray-900 mb-4">Welcome to AKASI Hotel</h1>
    <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">Book your perfect stay with real-time availability and secure Midtrans payments.</p>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($roomTypes as $roomType)
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow">
            @if($roomType->base_image)
                <img src="{{ $roomType->base_image }}" alt="{{ $roomType->name }}" class="w-full h-64 object-cover">
            @else
                <div class="w-full h-64 bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center">
                    <i class="fas fa-bed text-white text-6xl"></i>
                </div>
            @endif
<div class="p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $roomType->name }}</h3>
                <p class="text-gray-600 mb-4">{{ $roomType->description }}</p>
                
                {{-- Average Rating --}}
                @php
                    $avgRating = $roomType->reviews()->average('rating');
                    $reviewCount = $roomType->reviews()->count();
                @endphp
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400 text-lg">
                        {{ str_repeat('★', round($avgRating ?? 0)) }}
                        {{ str_repeat('☆', 5 - round($avgRating ?? 0)) }}
                    </div>
                    <span class="ml-2 text-sm text-gray-600">({{ number_format($avgRating ?? 0, 1) }} / {{ $reviewCount }} reviews)</span>
                </div>
                
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-users text-indigo-600 mr-2"></i>
                        <span>{{ $roomType->capacity }} guests</span>
                    </div>
                    <div class="text-2xl font-bold text-indigo-600">
                        Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }} /night
                    </div>
                </div>
                <a href="{{ route('rooms.show', $roomType) }}" 
                   class="w-full bg-indigo-600 text-white py-3 px-6 rounded-xl text-center font-semibold hover:bg-indigo-700 transition-colors block">
                    Check Availability
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-16">
            <i class="fas fa-bed text-6xl text-gray-400 mb-4"></i>
            <p class="text-xl text-gray-500">No room types available yet.</p>
        </div>
    @endforelse
</div>
@endsection

