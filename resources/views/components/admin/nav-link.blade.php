@props(['href', 'active' => false])

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'flex items-center rounded-xl px-3 py-2 text-sm font-medium transition '.($active
            ? 'bg-slate-100 text-slate-900'
            : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900')
    ]) }}
>
    {{ $slot }}
</a>
