@props([
    'name',
    'label' => null,
    'value' => null,
    'required' => false,
    'placeholder' => '',
    'rows' => 3,
    'helper' => null,
    'class' => '',
    'id' => null,
])

@php
    $generatedId = $id ?? 'input-' . md5($name . microtime());
@endphp

<div class="{{ $class }}">
    @if ($label)
        <label for="{{ $generatedId }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <textarea id="{{ $generatedId }}" name="{{ $name }}" rows="{{ $rows }}"
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        @if ($required) required @endif
        {{ $attributes->merge(['class' => 'w-full p-1 rounded border |focus:outline-blue-500 outline-none sm:text-sm']) }}>{{ old($name, $value) }}</textarea>

    @if ($helper)
        <p class="mt-1 text-sm text-gray-500">{{ $helper }}</p>
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
