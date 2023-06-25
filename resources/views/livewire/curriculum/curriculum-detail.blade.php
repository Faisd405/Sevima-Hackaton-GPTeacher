<div>
    <div class="flex justify-between mb-8">
        <x-header.title backLinkName="Home" backLink="{{ route('dashboard') }}">
            Curriculum Detail
        </x-header.title>
        <x-header.breadcrumbs :list="[['name' => 'Home', 'link' => '/'], 'Curriculum Detail']" />
    </div>

    <div class="p-4 mt-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg text-slate-800 dark:text-slate-200">
        <div class="max-w-full">
            <div class="flex justify-between pb-2 border-b">
                <h4 class="text-xl font-extrabold ">
                    {{ $curriculum['prompt'] }}
                </h4>
                <a class="btn-primary-custom" href="{{ route('curriculum.pdf', $curriculum['id']) }}" target="blank">
                    Generate PDF
                </a>
            </div>

            <div class="mt-2">
                {!! $curriculum['description'] !!}
            </div>

            <div class="pt-2 mt-4 border-t">
                <div class="flex items-center sm:block">
                    <button class="flex items-center btn-primary-custom" wire:click='favoriteCurriculum'>
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

                        <span class="hidden ml-2 sm:block">Favorite</span>
                    </button>
                    <span class="text-sm">
                        {{ $curriculum['favorite_count'] }} Favorites
                    </span>
                </div>


            </div>
        </div>
    </div>

    <div class="pt-4 mt-4 bg-white shadow dark:bg-gray-800 sm:rounded-lg text-slate-800 dark:text-slate-200">
        <div class="max-w-full">
            <h4 class="px-8 pb-2 text-xl font-extrabold border-b">
                Curriculum Detail
            </h4>

            <details class="border-b collapse md:hidden">
                <summary
                    class="text-lg font-medium text-center collapse-title hover:bg-slate-200 dark:hover:bg-gray-700">
                    {{ 'Select Curriculum Detail' }}
                </summary>
                <div class="collapse-content">
                    @foreach ($curriculum['curriculum_details'] as $curriculumDetail)
                        <div class="flex justify-between px-8 py-2 border-b cursor-pointer group hover:bg-slate-200 dark:hover:bg-gray-700"
                            wire:click="getCurriculumDetailProperty({{ $curriculumDetail['id'] }})">
                            <div class="group-hover:font-semibold">
                                {{ $curriculumDetail['title'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </details>

            <div class="grid grid-cols-4 mt-2">
                <div class="hidden border-r md:block border-r-black">
                    @foreach ($curriculum['curriculum_details'] as $curriculumDetail)
                        <div class="flex justify-between px-8 py-2 border-b cursor-pointer group hover:bg-slate-200 dark:hover:bg-gray-700"
                            wire:click="getCurriculumDetailProperty({{ $curriculumDetail['id'] }})">
                            <div class="group-hover:font-semibold">
                                {{ $curriculumDetail['title'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-span-4 md:col-span-3">
                    <div class="px-4 py-2">
                        @if ($curriculumDetailData)
                            <div class="flex items-center justify-between pb-2 border-b ">
                                <h4 class="text-xl font-extrabold">
                                    {{ $curriculumDetailData['title'] }}
                                </h4>
                            </div>
                            <div class="mt-2">
                                @if ($curriculumDetailData['content'])
                                    {!! $curriculumDetailData['content'] !!}
                                @else
                                    <div class="flex justify-center p-4">
                                        <div class="flex justify-center max-w-full py-4">
                                            <span x-show="loading"
                                                class="flex justify-center loading loading-spinner loading-lg"></span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="flex justify-center p-4">
                                No curriculum detail selected.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Comment --}}
    <div class="p-4 mt-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg text-slate-800 dark:text-slate-200">
        <div>
            <h4 class="pb-2 text-xl font-extrabold border-b">
                Comments
            </h4>
        </div>

        <div>
            @foreach ($curriculum['comment'] as $comment)
                @if ($comment['user_id'] == auth()->user()->id)
                    <div class="chat chat-start">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                                <img src="{{ $comment['user']['profile']['image_path'] ?? asset('assets/images/default_avatar.jpg') }}" />
                            </div>
                        </div>
                        <div class="chat-header">
                            {{ $comment['user']['name'] }}
                            <time class="text-xs opacity-50">
                                {{ Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}
                            </time>
                        </div>
                        <div class="bg-blue-500 chat-bubble dark:bg-blue-800 text-slate-50">
                            {{ $comment['comment'] }}
                        </div>
                    </div>
                @else
                    <div class="chat chat-end">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                                <img src="{{ $comment['user']['profile']['image_path'] ?? asset('assets/images/default_avatar.jpg') }}" />
                            </div>
                        </div>
                        <div class="chat-header">
                            {{ $comment['user']['name'] }}
                            <time class="text-xs opacity-50">
                                {{ Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}
                            </time>
                        </div>
                        <div class="chat-bubble">
                            {{ $comment['comment'] }}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="pt-4 mx-auto mt-4 border-t">
            <form wire:submit.prevent='commentCurriculum'>
                <div class="w-full">
                    <x-input.input-label class="text-sm font-extrabold" for="comment" value="Message" />
                    <x-input.textarea-input id="comment" name="comment" wire:model.lazy='comment' type="text"
                        x-bind:disabled="loading" required class="block w-full mt-1" />
                    <x-input.input-error :messages="$errors->get('comment')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end gap-4 mt-4">
                    <x-button.primary-button>
                        Send
                    </x-button.primary-button>
                </div>
            </form>
        </div>
    </div>

    {{-- Configuration --}}
    @if ($curriculum['user_id'] == auth()->user()->id)
        <div class="p-4 mt-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg text-slate-800 dark:text-slate-200">
            <div class="max-w-full">
                <div class="flex justify-between pb-2 font-extrabold border-b">
                    <h4 class="text-xl ">
                        Configuration
                    </h4>
                </div>
                <form wire:submit.prevent='saveConfigCurriculum' class="mt-4">
                    <div class="flex gap-4">
                        <x-input.input-label for="status" value="Status: " />
                        <x-input.select-input id="status" name="status" type="text" class="h-10 text-md"
                            wire:model.lazy='configCurriculum.status' :selected="$curriculum['status'] ?? 10">
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
