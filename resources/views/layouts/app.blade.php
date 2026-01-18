<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Koperasi Sekolah')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-700">
    <div class="min-h-screen">
        @include('layouts.navigation')
        <main class="px-6 py-8">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
