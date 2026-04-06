@extends('layouts.app')

@section('title', 'Beri Rating - ' . $booking->room->roomType->name)

@section('content')
<div class="max-w-2xl mx-auto py-12 px-4">
    <div class="bg-white rounded-3xl shadow-2xl p-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-black text-gray-900 mb-4">Bagaimana Pengalaman Menginap?</h1>
            <div class="flex justify-center gap-2 mb-8">
                <span class="text-3xl text-gray-400">★ ★ ★ ★ ★</span>
            </div>
            <p class="text-xl text-gray-600">Booking #{{ $booking->id }} - {{ $booking->room->room_number }}</p>
            <p class="text-lg font-semibold text-emerald-600 mt-2">{{ $booking->check_in->format('d M Y') }} - {{ $booking->check_out->format('d M Y') }}</p>
        </div>

        <form method="POST" action="{{ route('reviews.store', $booking) }}">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-xl font-semibold text-gray-900 mb-4">Rating Anda</label>
                    <div class="flex gap-2">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center text-3xl cursor-pointer hover:bg-yellow-100 transition-all @if(old('rating', $review->rating ?? 0) >= $i) bg-yellow-400 text-white shadow-lg shadow-yellow-200 @endif">
                                ★
                                <input type="radio" name="rating" value="{{ $i }}" class="hidden" {{ old('rating', $review->rating ?? 0) >= $i ? 'checked' : '' }} required>
                            </label>
                        @endfor
                    </div>
                    @error('rating')
                        <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xl font-semibold text-gray-900 mb-4">Komentar (Opsional)</label>
                    <textarea name="comment" rows="6" class="w-full p-6 border-2 border-gray-200 rounded-2xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 text-lg resize-vertical" placeholder="Ceritakan pengalaman Anda...">{{ old('comment', $review->comment ?? '') }}</textarea>
                    @error('comment')
                        <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4 pt-8">
                    <a href="{{ route('dashboard') }}" class="flex-1 bg-gray-100 text-gray-800 py-4 px-8 rounded-2xl font-semibold text-center hover:bg-gray-200 transition-all">Kembali</a>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white py-4 px-8 rounded-2xl font-bold text-lg shadow-xl hover:from-emerald-600 hover:to-emerald-700 transition-all">Kirim Review</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

