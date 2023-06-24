<div class="drawer-side">
    <label for="my-drawer" class="drawer-overlay"></label>
    <div
        class="w-64 h-full p-4 border-b border-gray-100 menu bg-slate-50 dark:bg-gray-800 dark:border-gray-700 text-base-content">
            <div class="flex flex-col overflow-auto grow" data-simplebar>
                <!-- Sidebar content here -->
                <div class="mb-2">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <x-slot:logo>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 28 28" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>

                        </x-slot>

                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                </div>
                <div>
                    <div class="py-1 my-2 text-center border-t border-b text-slate-800">
                        Subjects
                    </div>
                </div>
                <div>
                    <x-responsive-nav-link>
                        1. Crud Example
                    </x-responsive-nav-link>
                </div>
            </div>
        </div>
    </div>
</div>
