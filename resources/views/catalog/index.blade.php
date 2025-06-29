@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        @foreach ($categories as $category)
            @if ($category->products->count())
                <div class="mb-12">
                    <h2 class="text-4xl font-bold mb-6 border-b pb-2">{{ $category->name }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($category->products as $product)
                            <div class="bg-white p-6 rounded-lg shadow-md" data-product-id="{{ $product->id }}">
                                <h3 class="text-xl font-bold">{{ $product->name }}</h3>
                                <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                                <p class="text-blue-600 font-bold mt-2">@priceFormat($product->price)</p>

                                <div class="flex items-center mt-4">
                                    <button onclick="Cart.changeQuantity({{ $product->id }}, -1)"
                                        class="bg-gray-200 text-gray-800 px-3 py-1 rounded-l hover:bg-gray-300">
                                        −
                                    </button>
                                    <span id="quantity-{{ $product->id }}" class="bg-gray-100 px-4 py-1 text-center">
                                        {{ session('cart', [])[$product->id]['quantity'] ?? 1 }}
                                    </span>
                                    <button onclick="Cart.changeQuantity({{ $product->id }}, 1)"
                                        class="bg-gray-200 text-gray-800 px-3 py-1 rounded-r hover:bg-gray-300">
                                        +
                                    </button>

                                    @if ($product->inCart())
                                        <button onclick="Cart.removeFromCart({{ $product->id }})"
                                            class="ml-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 remove-from-cart-btn">
                                            Удалить
                                        </button>
                                    @else
                                        <button onclick="Cart.addToCart({{ $product->id }})"
                                            class="ml-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 add-to-cart-btn">
                                            В корзину
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
