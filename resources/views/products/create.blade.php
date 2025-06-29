@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Create Product</h1>

        <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
            @csrf
            @if (isset($product))
                @method('PUT')
            @endif

            <x-input name="name" label="Name" value="" required />

            <x-select name="category_id" label="Category" :options="$categories->pluck('name', 'id')" selected="" required />

            <x-textarea name="description" label="Description" value="" />

            <x-input name="price" label="Price (₽)" type="number" step="0.01" value="" required />

            <div class="flex justify-end space-x-3">
                <a href="{{ route('products.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md transition duration-300">Cancel</a>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-300">Save</button>
            </div>
        </form>
    </div>
@endsection
