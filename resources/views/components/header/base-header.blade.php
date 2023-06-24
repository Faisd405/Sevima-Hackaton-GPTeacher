@props([
    'title' => null,
    'list' => null,
])

<div class="flex justify-between mb-8">
    <x-header.title>
        {{ $title }}
    </x-header.title>
    <x-header.breadcrumbs :list="$list" />
</div>
