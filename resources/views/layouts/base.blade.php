<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.assets.meta')

    <title>{{ config('custom.custom.website_name') }}</title>

    @include('layouts.assets.font')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    @include('layouts.assets.jshead')
    @include('layouts.assets.css')

    @stack('styles')
    @stack('jshead')
</head>

<body class="font-sans antialiased" @stack('attribute-body')>
    @yield('body')

    @livewireScripts
    <x-toaster.toast-default />

    @stack('scripts')
    @include('layouts.assets.jsbody')
</body>

</html>
