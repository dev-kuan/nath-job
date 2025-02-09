@props([
'label',
'id',
'name',
'type' => 'text',
'icon' => '',
'placeholder' => '',
'icon' => '',
'required' => false,
'value' => ''

])

<div class="flex flex-col gap-2">
    <label for="{{ $id }}" class="font-semibold">{{ $label }}</label>
    <div
        class="flex items-center rounded-full p-[14px_24px] gap-[10px] ring-1 ring-[#0E0140] focus-within:ring-2 focus-within:ring-[#FF6B2C] transition-all duration-300">
        @if($icon)
        <div class="flex w-6 h-6 shrink-0">
            <img src="{{ asset($icon) }}" alt="icon">
        </div>
        @endif
        <input type="{{ $type }}" id="{{ $id }}" value="{{ $value }}" name="{{ $name }}" autocomplete="off"
            class="appearance-none w-full border-none font-semibold placeholder:font-normal placeholder:text-[#0E0140] focus:ring-0"
            placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $attributes }}>
    </div>
</div>