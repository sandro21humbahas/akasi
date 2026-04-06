@extends('components.guest-layout')

@section('title', 'Register - CHADS Coffee Hotel Akasi')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-emerald-50 via-white to-green-50">
    <div class="max-w-md w-full space-y-8 bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-emerald-100">
        <!-- Logo/Header -->
        <div class="text-center">
            <div class="mx-auto h-20 w-20 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl mb-6">
                <i class="fas fa-hotel text-3xl text-white"></i>
            </div>
            <h2 class="text-4xl font-black bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-2">
                CHADS Hotel
            </h2>
            <p class="text-lg text-gray-600 font-medium">Buat akun untuk reservasi mudah</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf
            
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-900 mb-2 tracking-wide">Nama Lengkap</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-user text-emerald-500"></i>
                    </div>
                    <x-text-input id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="pl-12 pr-4 py-4 rounded-2xl border-emerald-200 focus:border-emerald-500 focus:ring-emerald-200 text-lg" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-900 mb-2 tracking-wide">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-emerald-500"></i>
                    </div>
                    <x-text-input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username" class="pl-12 pr-4 py-4 rounded-2xl border-emerald-200 focus:border-emerald-500 focus:ring-emerald-200 text-lg" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-900 mb-2 tracking-wide">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-emerald-500"></i>
                    </div>
                    <x-text-input id="password" name="password" type="password" required autocomplete="new-password" class="pl-12 pr-4 py-4 rounded-2xl border-emerald-200 focus:border-emerald-500 focus:ring-emerald-200 text-lg" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-900 mb-2 tracking-wide">Konfirmasi Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-emerald-500"></i>
                    </div>
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="pl-12 pr-4 py-4 rounded-2xl border-emerald-200 focus:border-emerald-500 focus:ring-emerald-200 text-lg" />
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <x-primary-button class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-xl py-5 px-8 rounded-2xl font-bold shadow-xl transform hover:scale-[1.02] transition-all duration-300">
                    <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                </x-primary-button>
            </div>

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">
                        Masuk sekarang
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection

