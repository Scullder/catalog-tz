@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
    
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        
        <x-input
            name="name"
            label="Full Name"
            value="{{ old('name') }}"
            required
        />
        
        <x-input
            name="email"
            label="Email Address"
            type="email"
            value="{{ old('email') }}"
            required
        />
        
        <x-input
            name="password"
            label="Password"
            type="password"
            required
        />
        
        <x-input
            name="password_confirmation"
            label="Confirm Password"
            type="password"
            required
        />
        
        {{-- <div class="flex items-center">
            <x-checkbox
                name="terms"
                id="terms"
                required
            />
            <label for="terms" class="ml-2 text-sm text-gray-600">
                I agree to the <a href="#" class="text-blue-500 hover:text-blue-700">Terms of Service</a>
            </label>
        </div> --}}
        
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-300 mt-4">
            Register
        </button>
        
        <div class="text-center text-sm text-gray-500 mt-4">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Login</a>
        </div>
    </form>
</div>
@endsection