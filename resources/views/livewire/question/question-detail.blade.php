<div>
    <div class="flex justify-between mb-8">
        <x-header.title backLinkName="Home" backLink="{{ route('dashboard') }}">
            Question Detail
        </x-header.title>
        <x-header.breadcrumbs :list="[['name' => 'Home', 'link' => '/dashboard'], 'Question Detail']" />
    </div>

    <div class="p-4 mt-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg text-slate-800 dark:text-slate-200">
        <div class="max-w-full">
            <div class="flex justify-between pb-2 font-extrabold border-b">
                <h4 class="text-xl ">
                    {{ $question['prompt'] }}
                </h4>

            </div>

            <div class="mt-2">
                {!! $question['response'] !!}
            </div>

            <div class="pt-2 mt-4 border-t">
                <div>
                    <button class="flex items-center btn-primary-custom" wire:click='favoriteQuestion'>
                        @if (!$isFavorite)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif

                        <span class="ml-2">Favorite</span>
                    </button>
                    <span>
                        {{ $question['favorite_count'] }} Favorites
                    </span>
                </div>


            </div>
        </div>
    </div>

    @if ($question['user_id'] && auth()->user()->id)
        <div class="p-4 mt-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg text-slate-800 dark:text-slate-200">
            <div class="max-w-full">
                <div class="flex justify-between pb-2 font-extrabold border-b">
                    <h4 class="text-xl ">
                        Configuration
                    </h4>
                </div>
                <form wire:submit.prevent='saveConfigQuestion' class="mt-4">
                    <div class="flex gap-4">
                        <x-input.input-label for="status" value="Status: " />
                        <x-input.select-input id="status" name="status" type="text" class="h-10 text-md"
                            wire:model.lazy='configQuestion.status' :selected="$question['status'] ?? 10">
                            <option value="0">
                                Private
                            </option>
                            <option value="1">
                                Publish
                            </option>
                        </x-input.select-input>
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <x-button.primary-button>
                            Save Config
                        </x-button.primary-button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
