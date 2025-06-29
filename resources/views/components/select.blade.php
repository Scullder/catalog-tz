@props([
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'required' => false,
    'helper' => null,
    'class' => '',
    'id' => null,
])

@php
    $generatedId = $id ?? 'input-' . md5($name . microtime());
@endphp

<div class="{{ $class }}">
    @if($label)
        <label for="{{ $generatedId }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
            @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif
    
    <select
        id="{{ $generatedId }}"
        name="{{ $name }}"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'w-full p-1 rounded border outline-none sm:text-sm bg-white']) }}
    >
        @foreach($options as $value => $option)
            <option value="{{ $value }}" @selected(old($name, $selected) == $value)>
                {{ $option }}
            </option>
        @endforeach
    </select>
    
    @if($helper)
        <p class="mt-1 text-sm text-gray-500">{{ $helper }}</p>
    @endif
    
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>