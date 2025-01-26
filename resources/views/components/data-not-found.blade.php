@props(['message'])

<div class="flex flex-col items-center justify-center py-8">
    {{-- <img src="{{ asset('not-found.gif') }}" class="w-72 h-72" /> --}}
    <p class="text-lg text-gray-700 mt-4 font-semibold">
        {{ $message ?? 'Data tidak ditemukan.' }}
    </p>
</div>