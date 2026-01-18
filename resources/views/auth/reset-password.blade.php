@extends('layouts.guest')

@section('title', 'Reset Kata Sandi')

@section('content')

    <div class="mb-6">
        <x-application-logo />
    </div>

    <h1 class="text-xl font-semibold text-slate-900">Reset Kata Sandi</h1>
    <p class="mt-1 text-sm text-slate-500">Masukkan kata sandi baru untuk akun Anda.</p>

    <form method="POST" action="{{ route('password.store') }}" class="mt-6 space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" :value="old('email', $request->email)" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="password" value="Kata Sandi Baru" />
            <x-text-input id="password" name="password" type="password" required />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" required />
        </div>

        <x-primary-button class="w-full">Simpan Kata Sandi</x-primary-button>
    </form>
@endsection
