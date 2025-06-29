@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Create Order</h1>
    
    <form action="{{ route('orders.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <x-input
            name="customer_name"
            label="Customer Name"
            value="{{ old('customer_name') }}"
            required
        />
        
        <x-input
            name="created_at"
            label="Order Date"
            type="datetime-local"
            value="{{ old('created_at', now()->format('Y-m-d\TH:i')) }}"
            required
        />
        
        <x-select
            name="product_id"
            label="Product"
            :options="$products->mapWithKeys(fn($product) => [$product->id => $product->name.' ('.number_format($product->price, 2).' ₽)'])"
            selected="{{ old('product_id') }}"
            required
        />
        
        <x-input
            name="quantity"
            label="Quantity"
            type="number"
            min="1"
            value="{{ old('quantity', 1) }}"
            required
        />
        
        <x-textarea
            name="comment"
            label="Comment"
            value="{{ old('comment') }}"
        />
        
        <div class="flex justify-end space-x-3">
            <a href="{{ route('orders.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md transition duration-300">Cancel</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-300">Create Order</button>
        </div>
    </form>
</div>
@endsection