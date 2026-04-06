<button {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-lg rounded-2xl shadow-xl hover:shadow-2xl transform hover:scale-[1.02] active:scale-95 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-emerald-300 whitespace-nowrap']) }}>
    {{ $slot }}
</button>

