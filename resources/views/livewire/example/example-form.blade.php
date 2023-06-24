<div>
    <div class="flex justify-between mb-8">
        <x-header.title backLinkName="Example" backLink="{{ route('example.index') }}">
            {{ $exampleId ? 'Edit Example' : 'Create Example' }}
        </x-header.title>
        <x-header.breadcrumbs :list="[
            ['name' => 'Home', 'link' => '/'],
            ['name' => 'Crud Example', 'link' => route('example.index')],
            $exampleId ? 'Edit' : 'Create',
        ]" />
    </div>

    <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
        <div class="max-w-xl">
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Form Example
                </h2>
            </header>

            <form class="mt-6 space-y-6" wire:submit.prevent="save">
                <div>
                    <x-input.input-label for="name" value="Name" />
                    <x-input.text-input id="name" name="name" wire:model.lazy='exampleForm.name' type="text"
                        class="block w-full mt-1" />
                    <x-input.input-error :messages="$errors->exampleForm->get('name')" class="mt-2" />
                </div>
                <div>
                    <x-input.input-label for="description" value="Description" />
                    <x-input.text-input id="description" name="description" wire:model.lazy='exampleForm.description'
                        type="text" class="block w-full mt-1" />
                    <x-input.input-error :messages="$errors->exampleForm->get('description')" class="mt-2" />
                </div>

                <div class="flex items-center gap-4">
                    <x-button.primary-button>{{ __('Save') }}</x-button.primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
