@props(['title', 'value', 'icon', 'trend' => null, 'description' => null])

<div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-slate-500">{{ $title }}</p>
            <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $value }}</p>
        </div>
        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">
            {{ $icon }}
        </div>
    </div>
    @if ($description || $trend)
        <div class="mt-4 flex items-center gap-2 text-xs text-slate-500">
            @if ($trend)
                <span class="rounded-full bg-emerald-50 px-2 py-1 text-emerald-600">{{ $trend }}</span>
            @endif
            @if ($description)
                <span>{{ $description }}</span>
            @endif
        </div>
    @endif
</div>
