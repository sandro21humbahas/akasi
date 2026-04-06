<?php

namespace App\Http\Requests;

use App\Models\Booking;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        $booking = Booking::findOrFail($this->route('booking'));
        return Gate::allows('review', $booking);
    }

    public function rules(): array
    {
        return [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ];
    }
}

