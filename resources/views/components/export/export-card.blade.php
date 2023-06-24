@props([
    'titleExport' => null,
    'cacheKeyExport' => null,
    'batch' => null,
    'archive' => null,
    'xShow' => false,
    'exportAction' => null,
    'getBatchExportProperty' => null,
])

<div>
    <div class="mb-4" x-show="{{ $xShow }}" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90">
        <div wire:poll.750ms="getBatchExportProperty('{{ $cacheKeyExport }}')"
            class="w-full px-4 py-4 overflow-x-auto shadow-xl rounded-xl dark:bg-gray-800 bg-slate-100">
            <div class="flex justify-between px-2 pb-4 text-slate-800 dark:text-white rounded-xl">
                <span>
                    Export {{ $titleExport }} Progress
                </span>
                <div>
                    <button wire:click='{{ $exportAction }}' href="#"
                        class="px-4 py-2 text-sm btn-success-custom"
                        @if ($archive && $batch->progress() != 100)
                            disabled
                        @endif
                        >
                        <span class="hidden md:block">
                            Export {{ $titleExport }} Terbaru
                        </span>
                        <span class="block md:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
            @if ($batch !== null)
                <div class="mb-4">
                    <div class="overflow-hidden text-xs md:text-sm text-slate-800 dark:text-slate-200">
                        File Download:
                        @if ($archive && $batch->progress() == 100)
                            <a href="{{ asset($archive->file_path) }}" target="blank"
                                class="px-2 py-1 btn-primary-custom">
                                {{ $archive->file_name }}
                            </a>
                        @else
                            <span class="text-yellow-500 dark:text-yellow-500">
                                File is being processed
                            </span>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="w-full text-sm bg-gray-200 rounded-full dark:bg-gray-700">
                        <div class="bg-green-600 dark:bg-green-800 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                            style="width:  {{ $batch->progress() }}%">
                            {{ $batch->progress() }}%
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
