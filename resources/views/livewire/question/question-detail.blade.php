<div>
    <div class="flex justify-between mb-8">
        <x-header.title backLinkName="Home" backLink="{{ route('dashboard') }}">
            Question Detail
        </x-header.title>
        <x-header.breadcrumbs :list="[['name' => 'Home', 'link' => '/dashboard'], 'Question Detail']" />
    </div>

    <div class="p-4 mt-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg text-slate-800 dark:text-slate-200">
        <div class="max-w-full">
            <h4 class="pb-2 text-xl font-extrabold border-b">
                {{ $question['prompt'] }}
            </h4>

            <div class="mt-2">
                {!! $question['response'] !!}
            </div>
        </div>
    </div>
</div>
