@props([
    'id' => null,
    'type' => null,
    'name' => null,
    'label' => null,
    'value' => null,
    'required' => false,
    'attributes' => []
])

<div {{ $attributes->merge(['class' => 'space-y-1']) }}>
    @if($label)
        <label for="{{ $id }}" {{ $attributes->merge(['class' => 'block text-sm font-semibold text-gray-700 tracking-wide']) }}>
            {{ $label }}
        </label>
    @endif
    <input 
        id="{{ $id }}" 
        name="{{ $name ?? $id }}" 
        type="{{ $type ?? 'text' }}" 
        value="{{ $value ?? old($name ?? $id) }}" 
        {{ $required ? 'required' : '' }} 
        {{ $attributes->merge(['class' => 'w-full px-4 py-4 border border-gray-200 rounded-2xl shadow-sm focus:outline-none focus:ring-4 focus:ring-emerald-100 focus:border-emerald-400 placeholder-gray-400 transition-all duration-300 text-lg']) }} />
    <x-input-error :messages="$errors->get($name ?? $id)" class="mt-1" />
</div>

