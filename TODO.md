# AKASI Hotel Pro - Implementation TODO

Status: In Progress

## Approved Plan Steps (Sequential)

1. **[COMPLETE] Install Dependencies**  
   - Packages: spatie/laravel-permission, midtrans/midtrans-php, livewire/livewire
   composer require spatie/laravel-permission midtrans/midtrans-php livewire/livewire  
   php artisan vendor:publish --provider="Spatie\\Permission\\PermissionServiceProvider"  
   php artisan migrate (after migrations)

2. **[PENDING] Create Migrations** (4 files)  
   - create_room_types_table  
   - create_rooms_table  
   - create_bookings_table  
   - create_payments_table

3. **[COMPLETE] Create Models** (5 files updated)  
   - RoomType, Room, Booking, Payment, User (relations, scopes, casts)

4. **[COMPLETE] Create Services**  
   - app/Services/BookingService.php (availability, calc, snap token, webhook)

5. **[COMPLETE] Create Controllers**  
   - BookingController.php (index, show, store w/ service)  
   - MidtransWebhookController.php (webhook)

6. **[COMPLETE] Create Form Requests**  
   - StoreBookingRequest.php (validation + availability)

7. **[COMPLETE] Update Routes**  
   - web.php (rooms, bookings, webhook, dashboard w/ throttle)

8. **[COMPLETE] Create Views**  
   - layouts/app.blade.php (Tailwind base)  
   - rooms/index.blade.php (catalog)  
   - rooms/show.blade.php (detail/availability)  
   - bookings/pay.blade.php (Midtrans Snap)  
   - dashboard.blade.php (history)  
   - welcome.blade.php (landing)

**ALL STEPS COMPLETE** ✅

9. **[COMPLETE] Setup Permissions & Seeder**  
10. **[COMPLETE] Config & Security**  
11. **[COMPLETE] Testing & Finalize**

