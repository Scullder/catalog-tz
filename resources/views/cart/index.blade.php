@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Корзина</h1>

        @if (empty($products))
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <p class="text-gray-600 mb-4">Ваша корзина пуста</p>
                <a href="{{ route('catalog.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Вернуться к покупкам
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left">Товар</th>
                                    <th class="px-6 py-3 text-left">Цена</th>
                                    <th class="px-6 py-3 text-left">Количество</th>
                                    <th class="px-6 py-3 text-left">Сумма</th>
                                    <th class="px-6 py-3 text-left"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr class="border-b" data-product-id="{{ $item['product']->id }}">
                                        <td class="p-6">
                                            <div class="">
                                                <h3 class="font-medium">{{ $item['product']->name }}</h3>
                                                <p class="text-gray-500 text-sm">{{ $item['product']->category->name }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="p-6">@priceFormat ($item['price'])</td>
                                        <td class="p-6">
                                            <div class="flex items-center">
                                                <button onclick="Cart.changeQuantity({{ $item['product']->id }}, -1)"
                                                    class="bg-gray-200 text-gray-800 px-3 py-1 rounded-l hover:bg-gray-300">
                                                    −
                                                </button>
                                                <span id="quantity-{{ $item['product']->id }}"
                                                    class="bg-gray-100 px-4 py-1 text-center">
                                                    {{ $item['quantity'] }}
                                                </span>
                                                <button onclick="Cart.changeQuantity({{ $item['product']->id }}, 1)"
                                                    class="bg-gray-200 text-gray-800 px-3 py-1 rounded-r hover:bg-gray-300">
                                                    +
                                                </button>
                                            </div>
                                        </td>
                                        <td class="p-6">{{ $item['product_total_label'] }}</td>
                                        <td class="p-6">
                                            <button onclick="Cart.removeFromCart({{ $item['product']->id }})"
                                                class="text-red-500 hover:text-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Оформление заказа</h2>

                    <div class="mb-6">
                        <div class="flex justify-between mb-2">
                            <span>Товары ({{ count($products) }})</span>
                            <span id="cart-subtotal">{{ $total }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg">
                            <span>Итого</span>
                            <span id="cart-total">{{ $total }}</span>
                        </div>
                    </div>

                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <x-input name="customer_name" value="{{ auth()->user()?->name }}" label="ФИО" 
                            class="mb-4" />
                        <x-input name="customer_email" value="{{ auth()->user()?->email }}" label="Email" type="email"
                             class="mb-4" />
                        <x-textarea name="comment" label="Комментарий к заказу" value="" class="mb-4" />

                        <button type="submit"
                            class="w-full bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 transition">
                            Оформить заказ
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
