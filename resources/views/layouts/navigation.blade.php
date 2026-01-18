<nav class="border-b border-slate-200 bg-white px-6 py-4">
    <div class="flex items-center justify-between">
        <x-application-logo />
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-secondary-button type="submit">Logout</x-secondary-button>
        </form>
    </div>
</nav>
