<div x-data="{ deleteModal: false, exportCard: false, importCard: false }">
    <div class="mb-2">
        <x-header.base-header :title="'Crud Example'" :list="[['name' => 'Home', 'link' => '/'], 'Crud Example']" />

        <div class="flex flex-wrap justify-between mt-2 mb-4">
            <div class="flex items-end w-full mb-2 mr-2 space-x-4 sm:w-auto text-slate-800 dark:text-slate-200">
                <div>
                    <x-input.input-label for="search" value="Search" class="mr-2 text-sm" />
                    <x-input.text-input id="search" name="search" type="text" class="h-8 text-xs"
                        wire:model.lazy='params.search' />
                </div>
                <div>
                    <x-input.input-label for="limit" value="Limit" class="mr-2 text-sm" />
                    <x-input.select-input id="limit" name="limit" type="text" class="h-8 text-xs"
                        wire:model.lazy='params.limit' :selected="$request['limit'] ?? 10">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="50">100</option>
                    </x-input.select-input>
                </div>
            </div>
            <div class="flex items-end w-full mb-2 mr-2 space-x-4 sm:w-auto">
                <div class="flex items-end w-full gap-4 sm:w-auto">
                    <button
                        class="flex items-center justify-center w-full gap-2 text-sm shadow-md btn-info-custom text-slate-200"
                        @click="exportCard = !exportCard">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                        Export
                    </button>
                    {{-- <button
                        class="flex items-center justify-center w-full gap-2 text-sm shadow-md btn-info-custom text-slate-200"
                        @click="importCard = !importCard">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Import
                    </button> --}}
                </div>
                <div class="flex items-end w-full sm:w-auto">
                    <a href="{{ route('example.create') }}"
                        class="flex items-center justify-center w-full gap-2 text-sm shadow-md btn-primary-custom text-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Add New
                    </a>
                </div>
            </div>
        </div>

        <div>
            <x-export.export-card :titleExport="$titleExport" :cacheKeyExport="$cacheKeyExport" :batch="$exampleBatch" :archive="$exampleArchive" xShow="exportCard"
                exportAction="export" />
        </div>

        <div class="mb-4">
            <div class="w-full py-2 overflow-x-auto shadow-xl rounded-xl dark:bg-gray-800 bg-slate-100">
                <table class="table rounded-xl">
                    <!-- head -->
                    <thead class="font-semibold text-black dark:text-slate-200">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-black dark:text-slate-200">
                        @foreach ($examples as $key => $example)
                            <!-- row 1 -->
                            <tr>
                                <th>
                                    {{ $key + 1 + ($examples->currentPage() - 1) * $examples->perPage() }}
                                </th>
                                <td>
                                    {{ $example['name'] }}
                                </td>
                                <td>
                                    {{ $example['description'] }}
                                </td>
                                <td class="flex gap-2">
                                    <a href="{{ route('example.edit', ['id' => $example['id']]) }}"
                                        class="px-3.5 py-1 mb-2 mr-2 text-xs font-medium btn-warning-custom">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                        </svg>
                                    </a>
                                    <button @click="deleteModal =!deleteModal"
                                        wire:click="setSelectedId({{ $example['id'] }})"
                                        class="px-3.5 py-1 mb-2 mr-2 text-xs font-medium btn-danger-custom">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path fill-rule="evenodd"
                                                d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <dialog id="deleteModal" class="modal modal-bottom sm:modal-middle">
                    <div class="modal-box bg-slate-200 text-slate-800 dark:bg-gray-800 dark:text-slate-200">
                        <h3 class="text-lg font-bold">
                            Are you sure you want to delete this data?
                        </h3>
                        <p class="py-4">
                            if you delete this data, you will not be able to restore it again.
                        </p>
                        <div class="modal-action">
                            <!-- if there is a button in form, it will close the modal -->
                            <button class="btn btn-sm" wire:click='resetSelectedId'>Cancel</button>
                            <button class="text-white btn btn-sm btn-error" wire:click='delete()'>Delete</button>
                        </div>
                    </div>
                </dialog>
            </div>
            <div class="mt-4">
                {{ $examples->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>

    <x-modals.custom-modal modal_id="deleteModal" title="Delete Data" showCancelButton="true" showConfirmButton="true"
        confirmButtonText="Delete" typeButton="danger" description="Are you sure you want to delete this data?"
        wireAction="delete"></x-modals.custom-modal>
</div>
