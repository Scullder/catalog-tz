@props([
    'name',
    'label' => null,
    'required' => false,
    'id' => null,
])

@php
    $generatedId = $id ?? 'input-' . md5($name . microtime());
@endphp

<div class="flex items-center">
    <input type="checkbox" name="{{ $name }}" id="{{ $generatedId }}"
        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">

    @if (isset($label))
        <label for="{{ $generatedId }}" class="ml-2 block text-sm text-gray-700">
            {{ $label }}
        </label>
    @endif
</div>
