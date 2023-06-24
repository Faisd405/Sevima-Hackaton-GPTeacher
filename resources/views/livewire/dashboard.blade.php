<div>
    <div class="py-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col px-4 py-8 md:justify-between md:flex-row">
                        <div class="flex items-center gap-4">
                            <div>
                                <img src="{{ auth()->user()->profile->image_path ?? asset('assets/images/default_avatar.jpg') }}"
                                    class="object-cover w-24 h-24 rounded-full" alt="avatar">
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold">
                                    {{ auth()->user()->name }}
                                </h4>
                                <p class="text-sm font-semibold">
                                    {{ $totalCurriculum }} Curriculum - {{ $totalQuestion }} Question
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-2 mt-4">
                            <a href="{{ route('curriculum.create') }}" class="text-sm btn-primary-custom">
                                Create Curriculum
                            </a>
                            <a href="{{ route('question.create') }}" class="text-sm btn-primary-custom">
                                Create Question
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-50">
                        My Curriculum
                    </h2>
                </div>

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
                                <p class="mt-4 text-sm">
                                    {!! str()->limit($curriculum['description'], 75) !!}
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
                </div>
            </div>
            <div class="mb-3">
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-50">
                        My Question
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-2 xl:grid-cols-4">
                    @forelse ($questions as $question)
                        <a href="{{ route('question.show', $question->id) }}"
                            class="overflow-hidden transition duration-200 bg-white shadow-sm dark:bg-gray-800 sm:rounded-xl sm:shadow-lg dark:shadow-gray-700 hover:bg-slate-100 hover:scale-110 dark:hover:bg-slate-700">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h4 class="text-lg font-bold">
                                    {{ $question->prompt }}
                                </h4>
                                <p class="mt-4 text-sm">
                                    {!! str()->limit($question->response, 75) !!}
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
                </div>

                <div class="flex justify-center mt-12">
                    @if (count($questions) == 8)
                        <a href="{{ route('question.index') }}"
                            class="py-1.5 px-4 text-center hover:shadow-xl transition border border-blue-500 text-blue-500 rounded-lg  dark:border-blue-700 dark:hover:shadow-xl dark:shadow-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                            View All Question
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
