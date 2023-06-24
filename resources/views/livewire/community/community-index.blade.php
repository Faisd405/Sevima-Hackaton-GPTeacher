<div x-data="community">
    <div class="py-4">

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="tabs tabs-boxed bg-slate-200 dark:bg-gray-800 ">
                <a class="tab tab-md text-slate-800 dark:text-slate-50" @click="setTab(1)"
                    :class="{ 'tab-active': isSet(1) }">
                    Curriculum
                </a>
                <a class="tab tab-md text-slate-800 dark:text-slate-50" @click="setTab(2)"
                    :class="{ 'tab-active': isSet(2) }">
                    Question
                </a>
            </div>

            <div class="mb-3" x-show="isSet(1)">
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-50">
                        Curriculum
                    </h2>
                </div>

                <div
                    class="flex items-end w-full mt-2 mb-2 mr-2 space-x-4 sm:w-auto text-slate-800 dark:text-slate-200">
                    <div>
                        <x-input.input-label for="search" value="Search" class="mr-2 text-sm" />
                        <x-input.text-input id="search" name="search" type="text" class="h-8 text-xs"
                            wire:model.lazy='paramsCurriculum.search' />
                    </div>
                </div>

                <div class="mb-3">
                    <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-2 xl:grid-cols-4">
                        @forelse ($curriculums as $curriculum)
                            <a href="{{ route('curriculum.show', $curriculum['id']) }}"
                                class="overflow-hidden transition duration-200 bg-white shadow-sm dark:bg-gray-800 sm:rounded-xl sm:shadow-lg dark:shadow-gray-700 hover:bg-slate-100 hover:scale-110 dark:hover:bg-slate-700">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <h4 class="text-lg font-bold">
                                        {{ $curriculum['prompt'] }}
                                    </h4>
                                    <p class="text-xs font-semibold">
                                        {{ count($curriculum['curriculumDetails']) }} Materials
                                    </p>
                                    <p class="mt-4 overflow-hidden text-sm text-ellipsis">
                                        {!! str()->limit($curriculum['description'], 75) !!}
                                    </p>
                                    <p class="flex items-end justify-between mt-4 text-xs font-semibold">
                                        <span class="text-xs font-semibold">
                                            {{ $curriculum->favorite_count ?? 0 }} Favorites
                                        </span>

                                        <span class="text-xs font-semibold">
                                            {{ $curriculum->user->name }} -
                                            {{ $curriculum->created_at->diffForHumans() }}
                                        </span>
                                    </p>
                                </div>
                            </a>
                        @empty
                            <div class="flex flex-col items-center justify-center w-full h-64 col-span-4">
                                <p class="text-lg font-bold text-gray-500">
                                    No Curriculum Found
                                </p>
                            </div>
                        @endforelse
                        @if ($curriculums->hasMorePages())
                            <div class="flex flex-col items-center justify-center w-full col-span-4">
                                <button wire:click="loadMoreCurriculum" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500">
                                    Load More
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mb-3" x-show="isSet(2)">
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-50">
                        Question
                    </h2>
                </div>

                <div
                    class="flex items-end w-full mt-2 mb-2 mr-2 space-x-4 sm:w-auto text-slate-800 dark:text-slate-200">
                    <div>
                        <x-input.input-label for="search" value="Search" class="mr-2 text-sm" />
                        <x-input.text-input id="search" name="search" type="text" class="h-8 text-xs"
                            wire:model.lazy='paramsQuestion.search' />
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-2 xl:grid-cols-4">
                    @forelse ($questions as $question)
                        <a href="{{ route('question.show', $question->id) }}"
                            class="overflow-hidden transition duration-200 bg-white shadow-sm dark:bg-gray-800 sm:rounded-xl sm:shadow-lg dark:shadow-gray-700 hover:bg-slate-100 hover:scale-110 dark:hover:bg-slate-700">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h4 class="text-lg font-bold">
                                    {{ $question->prompt }}
                                </h4>
                                <p class="mt-4 overflow-hidden text-sm text-ellipsis">
                                    {!! str()->limit($question->response, 75) !!}
                                </p>
                                <p class="flex items-end justify-between mt-4 text-xs font-semibold">
                                    <span class="text-xs font-semibold">
                                        {{ $curriculum->favorite_count ?? 0 }} Favorites
                                    </span>
                                    <span class="text-xs font-semibold">
                                        {{ $question->user->name }} - {{ $question->created_at->diffForHumans() }}
                                    </span>
                                </p>
                            </div>
                        </a>
                    @empty
                        <div class="flex flex-col items-center justify-center w-full h-64 col-span-4">
                            <p class="text-lg font-bold text-gray-500">
                                No Question Found
                            </p>
                        </div>
                    @endforelse
                    @if ($questions->hasMorePages())
                        <div class="flex flex-col items-center justify-center w-full col-span-4">
                            <button wire:click="loadMoreQuestion" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500">
                                Load More
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('community', () => ({
                tab: 1,
                setTab(tab) {
                    this.tab = tab
                },
                isSet(tab) {
                    return this.tab === tab
                },
            }))
        })
    </script>
</div>
