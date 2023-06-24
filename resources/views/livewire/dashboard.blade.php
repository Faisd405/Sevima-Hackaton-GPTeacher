<div>
    <div class="py-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between px-4 py-8">
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
                                    0 Curriculum
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
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

                <div class="grid grid-cols-1 gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-4">
                    @for ($i = 0; $i < 4; $i++)
                        <div
                            class="overflow-hidden transition duration-200 bg-white shadow-sm dark:bg-gray-800 sm:rounded-xl sm:shadow-lg dark:shadow-gray-700 hover:bg-slate-100 hover:scale-110 dark:hover:bg-slate-700">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h4 class="text-lg font-bold">
                                    Curriculum {{ $i + 1 }}
                                </h4>
                                <p class="text-xs font-semibold">
                                    0 Subjects
                                </p>
                                <p class="mt-4 text-sm">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
                                </p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="mb-3">
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-50">
                        My Question
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($questions as $question)
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
