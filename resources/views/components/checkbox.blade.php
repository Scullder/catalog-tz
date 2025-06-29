@props([
    'name',
    'label' => null,
    'required' => false,
])

<div class="flex items-center">
    <input type="checkbox" name="{{ $name }}" id="{{ $name }}"
        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">

    @if (isset($label))
        <label for="{{ $name }}" class="ml-2 block text-sm text-gray-700">
            {{ $label }}
        </label>
    @endif
</div>
