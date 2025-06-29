@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <x-input name="email" label="Email" type="email" required class="w-full" />

            <x-input name="password" label="Password" type="password" required class="w-full" />

            <div class="flex items-center justify-between">
                <x-checkbox name="remember" label="Remember me" />

                {{-- @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:text-blue-700">
                        Forgot password?
                    </a>
                @endif --}}
            </div>

            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-300">
                Login
            </button>

            <div class="text-center text-sm text-gray-500 mt-4">
                Not registered yet?
                <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">Register</a>
            </div>
        </form>
    </div>
@endsection
