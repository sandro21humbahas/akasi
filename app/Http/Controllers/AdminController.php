<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
        ];
        
        $recent_bookings = Booking::with(['user', 'room.roomType'])->latest()->limit(10)->get();
        
        $rooms = Room::with('roomType')->get();
        
        return view('admin.dashboard', compact('stats', 'recent_bookings', 'rooms'));
    }
    
    public function rooms()
    {
        $rooms = Room::with('roomType')->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }
    
    public function createRoom()
    {
        $roomTypes = \App\Models\RoomType::all();
        return view('admin.rooms.create', compact('roomTypes'));
    }
    
    public function storeRoom(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number' => 'required|string|max:20|unique:rooms',
            'status' => 'required|in:available,booked,maintenance',
        ]);

        Room::create($request->all());

        return redirect('/admin/rooms')->with('success', 'Kamar berhasil ditambahkan!');
    }
}

