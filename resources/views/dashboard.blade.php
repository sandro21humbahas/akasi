@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">My Bookings</h1>
            <p class="text-gray-600">Manage your reservations and download invoices</p>
        </div>
    </div>

    @if(auth()->user()->bookings()->count() === 0)
        <div class="text-center py-24 bg-white rounded-3xl shadow-xl">
            <i class="fas fa-calendar-check text-8xl text-gray-300 mb-8"></i>
            <h3 class="text-3xl font-bold text-gray-900 mb-4">No bookings yet</h3>
            <p class="text-xl text-gray-600 mb-8">Book your first stay with AKASI Hotel</p>
            <a href="{{ route('rooms.index') }}" class="bg-indigo-600 text-white py-4 px-12 rounded-2xl font-bold hover:bg-indigo-700 transition-colors inline-block">
                <i class="fas fa-search mr-2"></i> Explore Rooms
            </a>
        </div>
    @else
        <div class="grid gap-6">
            @foreach(auth()->user()->bookings()->with('room.roomType', 'payment')->latest()->get() as $booking)
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-2xl mr-6">
                                {{ $booking->room->room_number }}
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $booking->room->roomType->name }}</h3>
                                <p class="text-gray-600">Check-in {{ $booking->check_in->format('d M Y') }} - Check-out {{ $booking->check_out->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-4 py-2 rounded-full text-sm font-bold 
                                @switch($booking->status)
                                    @case('pending') bg-yellow-100 text-yellow-800 @break
                                    @case('confirmed') bg-green-100 text-green-800 @break
                                    @case('cancelled') bg-red-100 text-red-800 @break
                                    @default bg-gray-100 text-gray-800
                                @endswitch">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Payment Status</h4>
                            @if($booking->payment)
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-credit-card mr-2 text-green-600"></i>
                                    {{ ucfirst($booking->payment->transaction_status) }} - {{ $booking->payment->transaction_id }}
                                </div>
                            @else
                                <span class="text-gray-500">Pending payment</span>
                            @endif
                        </div>
                        <div class="text-right md:text-left">
                            <div class="text-2xl font-bold text-indigo-600">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="#" onclick="printInvoice({{ $booking->id }})" class="bg-indigo-600 text-white py-2 px-6 rounded-xl hover:bg-indigo-700 transition-colors flex items-center">
                            <i class="fas fa-download mr-2"></i> Download Invoice
                        </a>
                        @if($booking->status === 'pending')
                            <span class="text-sm text-gray-500 italic">Complete payment to confirm</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
function printInvoice(bookingId) {
    // PDF generation logic (barryvdh/laravel-dompdf later)
    window.print();
}
</script>
@endsection

