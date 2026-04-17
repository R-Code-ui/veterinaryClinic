<nav x-data="{ open: false }" class="bg-white border-b border-[#FFD6A6]/50 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20"> <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="bg-[#FF9A86] p-2 rounded-xl text-white group-hover:rotate-12 transition-transform duration-300">
                            <x-application-logo class="block h-7 w-auto fill-current" />
                        </div>
                        <span class="font-bold text-xl tracking-tight text-[#4A3732] hidden md:block">VetPortal</span>
                    </a>
                </div>

                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex items-center">
                    @role('Client')
                        <x-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.dashboard')" class="text-[#706f6c] hover:text-[#FF9A86] transition-colors duration-200">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('client.pets.index')" :active="request()->routeIs('client.pets.*')" class="text-[#706f6c] hover:text-[#FF9A86]">
                            {{ __('My Pets') }}
                        </x-nav-link>
                        <x-nav-link :href="route('client.appointments.index')" :active="request()->routeIs('client.appointments.*')" class="text-[#706f6c] hover:text-[#FF9A86]">
                            {{ __('My Appointments') }}
                        </x-nav-link>
                    @endrole

                    @role('Admin|Vet')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-[#4A3732] font-semibold">
                            {{ __('Admin Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.pets.index')" :active="request()->routeIs('admin.pets.*')" class="text-[#706f6c]">
                            {{ __('Manage Pets') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.appointments.index')" :active="request()->routeIs('admin.appointments.*')" class="text-[#706f6c]">
                            {{ __('Manage Appointments') }}
                        </x-nav-link>

                        <div class="h-6 w-px bg-gray-200 mx-2"></div>

                        <x-nav-link :href="route('admin.reports.today-appointments')" :active="request()->routeIs('admin.reports.today-appointments')" class="text-[#FF9A86] text-xs uppercase tracking-widest font-bold">
                            {{ __('Today\'s Reports') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.reports.pets-multiple-records')" :active="request()->routeIs('admin.reports.pets-multiple-records')" class="text-[#706f6c] text-xs uppercase tracking-widest">
                            {{ __('Analytics') }}
                        </x-nav-link>
                    @endrole
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-[#FFD6A6] text-sm leading-4 font-medium rounded-2xl text-[#4A3732] bg-[#FFF0BE]/20 hover:bg-[#FFF0BE]/50 focus:outline-none transition-all duration-200">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#FF9A86] to-[#FFB399] flex items-center justify-center text-white mr-2 shadow-sm font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4 opacity-40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2 border-b border-gray-50 mb-1">
                                <p class="text-[10px] text-gray-400 uppercase font-black tracking-tighter">Account Settings</p>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-[#FFF0BE]/30 transition-colors">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        class="text-red-500 hover:bg-red-50 font-medium"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-[#FF9A86] bg-[#FFF0BE]/50 hover:bg-[#FFF0BE] focus:outline-none transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-[#FFD6A6]/20">
        <div class="pt-2 pb-3 space-y-1 px-3">
            @role('Client')
                <x-responsive-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.dashboard')" class="rounded-xl">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('client.pets.index')" :active="request()->routeIs('client.pets.*')" class="rounded-xl">
                    {{ __('My Pets') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('client.appointments.index')" :active="request()->routeIs('client.appointments.*')" class="rounded-xl">
                    {{ __('My Appointments') }}
                </x-responsive-nav-link>
            @endrole

            @role('Admin|Vet')
                <div class="px-4 py-2 text-[10px] font-bold text-[#FF9A86] uppercase tracking-widest">Management</div>
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="rounded-xl">
                    {{ __('Admin Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.pets.index')" :active="request()->routeIs('admin.pets.*')" class="rounded-xl">
                    {{ __('Manage Pets') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.appointments.index')" :active="request()->routeIs('admin.appointments.*')" class="rounded-xl">
                    {{ __('Manage Appointments') }}
                </x-responsive-nav-link>

                <div class="pt-2 pb-1 border-t border-gray-100 mt-2">
                    <div class="px-4 py-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Reporting & Data</div>
                    <x-responsive-nav-link :href="route('admin.reports.today-appointments')" :active="request()->routeIs('admin.reports.today-appointments')" class="rounded-xl">
                        {{ __('Appointments Report') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.reports.pets-multiple-records')" :active="request()->routeIs('admin.reports.pets-multiple-records')" class="rounded-xl">
                        {{ __('Record Analytics') }}
                    </x-responsive-nav-link>
                </div>
            @endrole
        </div>

        <div class="pt-4 pb-1 border-t border-[#FFD6A6]/20 bg-[#FFF0BE]/10">
            <div class="flex items-center px-4">
                <div class="shrink-0">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#FF9A86] to-[#FFB399] flex items-center justify-center text-white font-bold shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
                <div class="ms-3">
                    <div class="font-bold text-base text-[#4A3732]">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-[#706f6c]">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-3 pb-3">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl">
                    {{ __('Profile Settings') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            class="rounded-xl text-red-500 font-bold"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Sign Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
