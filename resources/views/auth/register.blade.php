@extends('layouts.guest')

@section('title', 'Daftar')

@section('content')

    <div class="mb-6">
        <x-application-logo />
    </div>

    <h1 class="text-xl font-semibold text-slate-900">Daftar Pengguna</h1>
    <p class="mt-1 text-sm text-slate-500">Formulir ini untuk kebutuhan pengujian awal.</p>

    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-5">
        @csrf

        <div>
            <x-input-label for="name" value="Nama Lengkap" />
            <x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="password" value="Kata Sandi" />
            <x-text-input id="password" name="password" type="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" />
        </div>

        <x-primary-button class="w-full">Daftar</x-primary-button>

        <p class="text-center text-sm text-slate-500">
            Sudah punya akun?
            <a class="font-semibold text-slate-700 hover:text-slate-900" href="{{ route('login') }}">Masuk</a>
        </p>
    </form>
@endsection
