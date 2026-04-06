@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Hotel" class="w-full h-full object-cover opacity-80">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/20 to-purple-900/20"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-24">
            <div class="text-center">
                <h1 class="text-6xl md:text-7xl font-black bg-gradient-to-r from-emerald-400 via-emerald-200 to-yellow-300 bg-clip-text text-transparent mb-8 drop-shadow-2xl animate-pulse">
                    CHADS Coffee Hotel Akasi
                </h1>
                <p class="text-2xl md:text-3xl text-indigo-100 mb-12 max-w-3xl mx-auto drop-shadow-lg">
                    Luxury stays with real-time booking & secure payments. Your perfect getaway awaits.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center max-w-2xl mx-auto">
                    <a href="{{ route('rooms.index') }}" class="bg-white text-indigo-600 px-12 py-6 rounded-3xl text-xl font-bold hover:bg-indigo-50 hover:scale-105 transition-all duration-300 shadow-2xl">
                        <i class="fas fa-search mr-3"></i> Explore Rooms
                    </a>
                    <a href="/login" class="border-2 border-white text-white px-12 py-6 rounded-3xl text-xl font-bold hover:bg-white hover:text-indigo-600 transition-all duration-300">
                        Login / Register
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Search Floating -->
    <div class="fixed bottom-8 right-8 bg-white/95 backdrop-blur-md shadow-2xl rounded-3xl p-6 w-80 md:w-96 z-50 border border-white/50 hover:shadow-3xl transition-all">
        <h3 class="text-lg font-bold mb-4">Quick Check Availability</h3>
        <form action="{{ route('rooms.index') }}" method="GET" class="space-y-3">
            <input type="date" name="check_in" required min="{{ now()->format('Y-m-d') }}" class="w-full p-3 border border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2">
            <input type="date" name="check_out" required class="w-full p-3 border border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2">
            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-6 rounded-xl font-bold hover:from-indigo-700 hover:to-purple-700 transition-all">
                Search Rooms
            </button>
        </form>
    </div>

    <!-- Features & Location -->
    <div class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hotel Advantages -->
            <div class="text-center mb-24">
                <h2 class="text-5xl font-black bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-6">
                    Mengapa Pilih AKASI?
                </h2>
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="group">
                        <div class="w-24 h-24 bg-gradient-to-br from-emerald-400 to-green-500 rounded-3xl mx-auto mb-6 flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-bolt text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900">Real-time Booking</h3>
                        <p class="text-gray-600">Cek ketersediaan instan, no double booking</p>
                    </div>
                    <div class="group">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-3xl mx-auto mb-6 flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-shield-alt text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900">Midtrans Secure</h3>
                        <p class="text-gray-600">Pembayaran aman bersertifikat</p>
                    </div>
                    <div class="group">
                        <div class="w-24 h-24 bg-gradient-to-br from-orange-400 to-red-500 rounded-3xl mx-auto mb-6 flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-bed text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900">5⭐ Fasilitas</h3>
                        <p class="text-gray-600">AC, WiFi cepat, sarapan gratis, kolam renang</p>
                    </div>
                    <div class="group">
                        <div class="w-24 h-24 bg-gradient-to-br from-purple-400 to-pink-500 rounded-3xl mx-auto mb-6 flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-map-marker-alt text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900">Lokasi Prima</h3>
                        <p class="text-gray-600">Jakarta Pusat - Dekat MRT & CBD</p>
                    </div>
                </div>
            </div>

            <!-- Google Map -->
            @include('partials.map')
        </div>
    </div>
</div>

<style>
.hover\\:scale-105:hover { transform: scale(1.05); }
</style>
@endsection

