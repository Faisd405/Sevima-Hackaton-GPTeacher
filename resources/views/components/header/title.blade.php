@props([
    'backLink' => '',
    'backLinkName' => '',
])

<h2 class="flex-col text-lg font-bold md:text-2xl md:flex text-slate-800 dark:text-slate-200">
    @if ($backLink && $backLinkName)
    <div>
        <a href="{{ $backLink }}" class="text-sm font-semibold md:text-base text-slate-600 dark:text-slate-400 hover:underline"> {{ $backLinkName }} /</a>
    </div>
    @endif
    {{ $slot }}
</h2>
