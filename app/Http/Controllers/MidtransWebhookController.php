<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\Request;

class MidtransWebhookController extends Controller
{
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function handle(Request $request)
    {
        $payload = $request->all();

        $this->bookingService->handleWebhook($payload);

        return response('OK', 200);
    }
}

