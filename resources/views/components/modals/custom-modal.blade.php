@props([
    'modal_id' => false,
    'title' => 'Modal Title',
    'description' => '',

    'typeButton' => 'info',
    'showConfirmButton' => false,
    'showCancelButton' => false,
    'showCloseButton' => false,

    'confirmButtonText' => 'Submit',
    'cancelButtonText' => 'Cancel',

    'wireAction' => '',
    'alpineAction' => '',
])

@php
    $typeButtonClass = 'btn-primary-custom';
    if ('danger') {
        $typeButtonClass = 'btn-danger-custom';
    } elseif ('warning') {
        $typeButtonClass = 'btn-warning-custom';
    }
@endphp

<div x-show="{{ $modal_id }}" :class="{ 'hidden': !{{ $modal_id }} }" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">

        {{-- Blur --}}
        <div x-cloak @click="{{ $modal_id }} = false" x-show="{{ $modal_id }}"
            x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

        {{-- Modal --}}
        <div class="flex items-end justify-center w-full h-screen sm:w-auto sm:items-center">
            <div x-cloak x-show="{{ $modal_id }}" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full max-w-xl p-8 overflow-hidden text-left transition-all transform bg-white rounded-t-lg shadow-xl dark:bg-gray-800 sm:rounded-lg 2xl:max-w-2xl">
                {{-- Title --}}
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-bold text-gray-800 dark:text-slate-50">
                        {{ $title }}
                    </h1>
                    @if ($showCloseButton)
                        <button @click="{{ $modal_id }} = false"
                            class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    @endif
                </div>

                {{-- Description --}}
                <p class="mt-2 text-sm text-gray-500 dark:text-slate-200">
                    {{ $description }}
                </p>

                {{-- Content --}}
                <div class="mt-4">
                    {{ $slot }}
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end mt-4">
                    @if ($showCancelButton)
                        <button @click="{{ $modal_id }} = false"
                            class="px-4 py-2 text-sm font-medium btn-secondary-custom">
                            {{ $cancelButtonText }}
                        </button>
                    @endif

                    @if ($showConfirmButton)
                        <button @click=" {{ $modal_id }} = false; {{ $alpineAction }} " wire:click='{{ $wireAction }}'
                            class="px-4 py-2 ml-4 text-sm font-medium {{ $typeButtonClass }}">
                            {{ $confirmButtonText }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
