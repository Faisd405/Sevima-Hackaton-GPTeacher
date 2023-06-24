@props(['active', 'logo'])

@php
    $classes = ($active ?? false)
        ? 'flex block w-full pl-3 pr-4 py-2 border-b-2 border-slate-400 dark:border-slate-200 dark:border-slate-400 text-left text-sm font-bold text-slate-700 dark:text-slate-100 transition duration-150 ease-in-out rounded-md dark:bg-[radial-gradient(ellipse_at_bottom,_var(--tw-gradient-stops))] dark:from-slate-600 dark:via-slate-700 dark:to-slate-800 bg-[radial-gradient(ellipse_at_bottom,_var(--tw-gradient-stops))] from-slate-300 via-slate-200 to-slate-50'
        : 'flex block w-full pl-3 pr-4 py-2 border-b-2 border-transparent text-left text-sm font-medium text-gray-600 hover:bg-gray-200 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 dark:hover:border-gray-600 transition duration-150 ease-in-out rounded-md dark:hover:bg-slate-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if($logo ?? null)
    <span class="w-8">
        {{ $logo }}
    </span>
    @else
    <span class="w-8"></span>
    @endif

    {{ $slot }}
</a>
