@extends('layouts.admin')

@section('title', 'Tambah Kamar Baru')

@section('content')
<div class="max-w-2xl">
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Kamar Baru</h1>
            <p class="text-gray-600">Isi detail kamar untuk ditambahkan ke sistem.</p>
        </div>

        <form method="POST" action="/admin/rooms">
            @csrf
            <div class="space-y-6 bg-white p-8 rounded-xl shadow-lg">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Kamar <span class="text-red-500">*</span></label>
                    <select name="room_type_id" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Tipe Kamar</option>
                        @foreach(\App\Models\RoomType::all() as $type)
                        <option value="{{ $type->id }}">{{ $type->name }} (Rp {{ number_format($type->price_per_night, 0, ',', '.') }}/malam)</option>
                        @endforeach
                    </select>
                    @error('room_type_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Kamar <span class="text-red-500">*</span></label>
                    <input type="text" name="room_number" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="101, 202, Deluxe A, dll">
                    @error('room_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="available">Tersedia</option>
                            <option value="booked">Booked</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                </div>

                <div class="flex space-x-4 pt-4">
                    <a href="/admin/rooms" class="flex-1 text-center py-3 px-6 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium">Batal</a>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-6 rounded-lg hover:from-blue-700 hover:to-blue-800 font-semibold shadow-lg hover:shadow-xl transition-all duration-200">Tambah Kamar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

