@props([
    'backLink' => '',
    'backLinkName' => '',
])

<h2 class="flex-col text-lg font-bold md:text-2xl md:flex text-slate-800 dark:text-slate-200">
    @if ($backLink && $backLinkName)
        <a class="flex items-center hover:underline" href="{{ $backLink }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span class="text-sm font-semibold md:text-base text-slate-600 dark:text-slate-400">
                {{ $backLinkName }} </span>

        </a>
    @endif
    <div class="mt-8">
        {{ $slot }}
    </div>
</h2>
