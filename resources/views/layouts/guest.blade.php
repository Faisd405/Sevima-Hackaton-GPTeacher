@extends('layouts.base')

@section('body')
    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0 dark:bg-gray-900">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-200">
                {{ config('custom.custom.website_name') }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ config('custom.custom.website_description') }}
            </p>
        </div>

        <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md dark:bg-gray-800 sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
@endsection

@stack('modals')
