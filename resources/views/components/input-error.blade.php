@props(['messages' => []])

@if ($messages)
    <div class="mt-2">
        @foreach ($messages as $message)
            <p class="text-sm text-red-600 bg-red-50 border border-red-200 rounded-xl px-4 py-2">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
            </p>
        @endforeach
    </div>
@endif

