<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Product & Order Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <nav class="bg-gray-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="/" class="text-xl font-bold">Product & Order Management</a>
                    </div>
                    @auth
                        @if (auth()->user()->role == 'admin')
                            <div class="hidden md:block">
                                <div class="ml-10 flex items-baseline space-x-4">
                                    <a href="{{ route('products.index') }}"
                                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 {{ request()->routeIs('products.*') ? 'bg-gray-900' : '' }}">Products</a>
                                    <a href="{{ route('orders.index') }}"
                                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 {{ request()->routeIs('orders.*') ? 'bg-gray-900' : '' }}">Orders</a>
                                </div>
                            </div>
                        @endif
                    @endauth
                    <a href="{{ route('cart.index') }}"
                        class="flex items-center px-3 py-2 hover:bg-gray-700 rounded-md ml-4">
                        <b>Корзина</b>
                        <span id="cart-count" class="ml-1 bg-blue-500 text-white text-xs px-2 py-1 rounded-full">
                            {{ count(session('cart', [])) }}
                        </span>
                    </a>
                </div>
                <div class="ml-4 flex items-center">
                    @auth
                        <b class="mr-2">{{ auth()->user()->name }}</b>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Login</a>
                        <a href="{{ route('register') }}"
                            class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
