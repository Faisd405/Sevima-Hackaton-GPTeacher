@extends('layouts.base')

@section('body')
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Page Content -->
        <div class="drawer lg:drawer-open" x-data="{ drawerOpen: false }">
            <input id="my-drawer" type="checkbox" class="drawer-toggle" />
            <div class="overflow-x-auto drawer-content">
                @include('layouts.partials.navigation')
                <main class="px-8 py-12">
                    @yield('content')

                    @isset($slot)
                        {{ $slot }}
                    @endisset
                </main>
            </div>
            @include('layouts.partials.sidebar')
            @stack('sidebar')
        </div>
    </div>
@endsection

@stack('modals')

@push('scripts')
<script>
    document.querySelector('.drawer-toggle').addEventListener('click', () => {
        if (document.querySelector('.drawer-toggle').checked) {
            document.querySelector('.drawer-content').classList.add('blur-sm')
            document.querySelector('body').classList.add('overflow-hidden')
        } else {
            document.querySelector('.drawer-content').classList.remove('blur-sm')
            document.querySelector('body').classList.remove('overflow-hidden')
        }
    })
    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024) {
            document.querySelector('.drawer-content').classList.remove('blur-sm')
            document.querySelector('body').classList.remove('overflow-hidden')
        }
    })
</script>
@endpush
