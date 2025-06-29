@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Редактирование товара</h1>

        <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-6">
            @csrf
            @if (isset($product))
                @method('PUT')
            @endif

            <x-input name="name" label="Название" value="{{ $product->name ?? '' }}" required />

            <x-select name="category_id" label="Категория" :options="$categories->pluck('name', 'id')" selected="{{ $product->category_id ?? '' }}"
                required />

            <x-textarea name="description" label="Описание" value="{{ $product->description ?? '' }}" />

            <x-input name="price" label="Цена (₽)" type="number" step="0.01" value="{{ $product->price ?? '' }}"
                required />

            <div class="flex justify-end space-x-3">
                <a href="{{ route('products.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md transition duration-300">Отмена</a>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-300">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
