@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Order Details</h1>
    
    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Order #{{ $order->id }}</h2>
                <p class="text-sm text-gray-500 mt-1">{{ $order->created_at->format('Y-m-d H:i') }}</p>
            </div>
            
            <div>
                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $order->status == 'new' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>
        
        <div class="border-t border-gray-200 pt-4">
            <h3 class="text-lg font-medium text-gray-800 mb-3">Customer Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Customer Name</p>
                    <p class="text-gray-800">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Comment</p>
                    <p class="text-gray-800">{{ $order->comment ?? 'No comment' }}</p>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-200 pt-4">
            <h3 class="text-lg font-medium text-gray-800 mb-3">Order Items</h3>
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-800">{{ $order->product->name }}</p>
                        <p class="text-sm text-gray-500">{{ $order->product->category->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-800">{{ $order->quantity }} × {{ number_format($order->product->price, 2) }} ₽</p>
                        <p class="font-medium text-gray-800 mt-1">{{ number_format($order->total_price, 2) }} ₽</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end space-x-3 pt-4">
            @if($order->status == 'new')
            <form action="{{ route('orders.complete', $order) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-300">Mark as Completed</button>
            </form>
            @endif
            <a href="{{ route('orders.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md transition duration-300">Back to List</a>
        </div>
    </div>
</div>
@endsection