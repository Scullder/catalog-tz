@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Регистрация</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <x-input name="name" label="Имя" value="{{ old('name') }}" required />
            <x-input name="email" label="Email" type="email" value="{{ old('email') }}" required />
            <x-input name="password" label="Пароль" type="password" required />
            <x-input name="password_confirmation" label="Подтверждение пароля" type="password" required />

            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-300 mt-4">
                Зарегистрироваться
            </button>

            <div class="text-center text-sm text-gray-500 mt-4">
                Уже зарегестрированы?
                <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Вход</a>
            </div>
        </form>
    </div>
@endsection
