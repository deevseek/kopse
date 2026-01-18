@extends('layouts.guest')

@section('title', 'Lupa Kata Sandi')

@section('content')

    <div class="mb-6">
        <x-application-logo />
    </div>

    <h1 class="text-xl font-semibold text-slate-900">Lupa Kata Sandi</h1>
    <p class="mt-1 text-sm text-slate-500">Masukkan email untuk menerima tautan reset kata sandi.</p>

    <x-auth-session-status class="mt-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <x-primary-button class="w-full">Kirim Tautan Reset</x-primary-button>

        <p class="text-center text-sm text-slate-500">
            <a class="font-semibold text-slate-700 hover:text-slate-900" href="{{ route('login') }}">Kembali ke Login</a>
        </p>
    </form>
@endsection
