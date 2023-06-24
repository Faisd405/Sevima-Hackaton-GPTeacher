<div class="drawer-side">
    <label for="my-drawer" class="drawer-overlay"></label>
    <div
        class="w-64 h-full p-4 border-b border-gray-100 rounded-br-xl menu bg-slate-50 dark:bg-gray-800 dark:border-gray-700 text-base-content">
        <div class="w-full pb-6 mt-8 mb-2 border-b-2">
            <div class="text-xl font-extrabold text-center text-gray-600 dark:text-gray-400">
                {{ config('custom.custom.website_name') }}
            </div>
        </div>
            <div class="flex flex-col overflow-auto grow" data-simplebar>
                <!-- Sidebar content here -->
                <div class="mb-2">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <x-slot:logo>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 28 28" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>

                        </x-slot>

                        Home
                    </x-responsive-nav-link>
                    <x-responsive-nav-link class="mt-2" :href="route('community')" :active="request()->routeIs('community')">
                        <x-slot:logo>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                        </x-slot>
                        Community Showcase
                    </x-responsive-nav-link>
                </div>
            </div>
        </div>
    </div>
</div>
