<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Autentikasi') - Koperasi Sekolah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-700">
    <div class="flex min-h-screen items-center justify-center px-6 py-12">
        <div class="w-full max-w-md rounded-3xl border border-slate-100 bg-white p-8 shadow-sm">
            @yield('content')
        </div>
    </div>
</body>
</html>
