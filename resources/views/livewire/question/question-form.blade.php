<div x-data="questionForm" x-on:finished.window="loading = false; generated = true">
    <div class="flex justify-between mb-8">
        <x-header.title backLinkName="Home" backLink="{{ route('dashboard') }}">
            Create Question
        </x-header.title>
        <x-header.breadcrumbs :list="[['name' => 'Home', 'link' => '/dashboard'], 'Create Question']" />
    </div>

    <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
        <div class="max-w-full">
            <form class="space-y-6" @submit.prevent="generateForm">
                <div class="mx-auto">
                    <div class="mx-auto">
                        <x-input.input-label class="text-xl font-extrabold" for="prompt"
                            value="What You Want to know ?" />
                        {{-- disabled when loading is true --}}
                        <x-input.text-input id="prompt" name="prompt" wire:model.lazy='prompt' type="text"
                            x-bind:disabled="loading" required placeholder="Web Programming"
                            class="block w-full mt-1" />
                        <x-input.input-error :messages="$errors->get('prompt')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4">
                    <x-button.primary-button>
                        Generate
                    </x-button.primary-button>
                </div>
            </form>
        </div>
    </div>


    <div x-show="loading"
        class="p-4 mt-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg text-slate-800 dark:text-slate-200">
        <div class="flex justify-center max-w-full py-4">
            <span x-show="loading" class="flex justify-center loading loading-spinner loading-lg"></span>
        </div>
    </div>

    <div x-show="generated"
        class="p-4 mt-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg text-slate-800 dark:text-slate-200">
        <div class="max-w-full">
            @if ($titlePrompt)
                <h4 class="pb-2 text-xl font-extrabold border-b">
                    {{ $titlePrompt }}
                </h4>
            @endif

            <div class="mt-2" x-show="!loading">
                {!! $response !!}
            </div>

            <div class="flex justify-center mt-4">
                <x-button.primary-button @click.prevent="saveQuestion">
                    Save
                </x-button.primary-button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('questionForm', () => ({
                loading: false,
                generated: false,

                generateForm() {
                    this.loading = true
                    this.generated = false

                    @this.generate()
                },

                saveQuestion() {
                    this.loading = false
                    this.generated = false

                    @this.saveQuestion()
                }
            }))
        })
    </script>
</div>
