<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-text-input id="email" name="email" label="Email Address" value="{{ old('email') }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="password" name="password" label="Password" type="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center mt-4">
            <label class="flex items-center">
                <input id="remember_me" name="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-50" {{ old('remember') ? 'checked' : '' }}>
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>

        <div class="flex items-center gap-4 mt-6">
            <x-primary-button>Log in</x-primary-button>

            <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                New User? Register
            </a>
        </div>
    </form>
</x-guest-layout>

