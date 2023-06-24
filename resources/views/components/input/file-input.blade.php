@props(['disabled' => false, 'preview_action' => null])

<div class="inline-flex w-full gap-2">
    <input
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => 'file-input bg-white border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}
    >

    @if ($preview_action)
    <div class="flex items-center justify-center">
        <button class="btn-info-custom" wire:click="{{ $preview_action }}">Preview</button>
    </div>
    @endif
</div>
