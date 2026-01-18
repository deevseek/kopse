@extends('layouts.guest')

@section('title', 'Masuk')

@section('content')

    <div class="mb-6">
        <x-application-logo />
    </div>

    <h1 class="text-xl font-semibold text-slate-900">Masuk</h1>
    <p class="mt-1 text-sm text-slate-500">Silakan login untuk mengakses sistem koperasi.</p>

    <x-auth-session-status class="mt-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="password" value="Kata Sandi" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2 text-slate-600">
                <input type="checkbox" name="remember" class="rounded border-slate-300 text-slate-900 focus:ring-slate-400">
                Ingat saya
            </label>

            <a class="text-slate-600 hover:text-slate-900" href="{{ route('password.request') }}">Lupa kata sandi?</a>
        </div>

        <x-primary-button class="w-full">Masuk</x-primary-button>
    </form>
@endsection
