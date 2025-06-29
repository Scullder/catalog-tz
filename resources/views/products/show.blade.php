@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Детали товара</h1>
    
    <div class="space-y-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Категория</p>
                <p class="text-gray-800">{{ $product->category->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Цена</p>
                <p class="text-gray-800">@priceFormat ($product->price)</p>
            </div>
        </div>
        
        <div>
            <p class="text-sm text-gray-500">Описание</p>
            <p class="text-gray-800">{{ $product->description }}</p>
        </div>
        
        <div class="flex space-x-3 pt-4">
            <a href="{{ route('products.edit', $product) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition duration-300">Изменить</a>
            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-300">Удалить</button>
            </form>
            <a href="{{ route('products.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md transition duration-300">Вернуться к списку</a>
        </div>
    </div>
</div>
@endsection