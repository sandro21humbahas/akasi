@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-3xl shadow-2xl p-12 mb-8">
        <div class="text-center mb-12">
            <div class="w-24 h-24 bg-green-100 rounded-3xl mx-auto mb-6 flex items-center justify-center">
                <i class="fas fa-receipt text-3xl text-green-600"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Secure Payment</h1>
            <p class="text-xl text-gray-600">Complete your booking with Midtrans Snap</p>
        </div>

        <div class="bg-gray-50 rounded-2xl p-8 mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Booking Summary</h3>
            <div class="space-y-4">
                <div class="flex justify-between">
                    <span>Room {{ $booking->room->room_number }} ({{ $booking->room->roomType->name }})</span>
                    <span>Rp {{ number_format($booking->room->roomType->price_per_night, 0, ',', '.') }} × {{ $booking->nights }} nights</span>
                </div>
                <div class="flex justify-between pt-4 border-t border-gray-200 font-bold text-xl text-indigo-600">
                    <span>Total</span>
                    <span>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                </div>
                <div class="pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500">Check-in: {{ $booking->check_in->format('d M Y') }} | Check-out: {{ $booking->check_out->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <div id="snap-container"></div>
    </div>

    <div class="text-center text-sm text-gray-500">
        Secure payment powered by <strong>Midtrans</strong>
    </div>
</div>

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script id="snap-token" type="text/json">{{ $snapToken }}</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const snapToken = document.getElementById('snap-token').textContent;
    snap.pay(snapToken, {
        onSuccess: function(result) {
            window.location.href = '/dashboard';
        },
        onPending: function(result) {
            console.log('pending', result);
        },
        onError: function(result) {
            console.log('error', result);
        }
    });
});
</script>
@endpush
@endsection
</xai:function_call.

<xai:function_call name="create_file">
<parameter name="absolute_path">c:/laragon/www/akasihotel/resources/views/dashboard.blade.php
