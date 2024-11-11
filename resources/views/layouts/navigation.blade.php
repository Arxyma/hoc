<nav x-data="{ open: false, eventDropdownOpen: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                {{-- @can('admin', 'admin')
                <!-- This link only shows for admin -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                        {{ __('Events') }}
                    </x-nav-link>
                </div>
                 @endcan
                 @can('admin', 'admin')
                <!-- This link only shows for admin -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('mentors.index')" :active="request()->routeIs('mentors.index')">
                        {{ __('Mentors') }}
                    </x-nav-link>
                </div>
                 @endcan --}}
                @can('admin', 'admin')
                    <!-- Dropdown for Admins Only -->
                    <div class="relative hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <button @click="eventDropdownOpen = !eventDropdownOpen"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <span>{{ __('Events') }}</span>
                            <svg class="ml-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                        <!-- Navigation Links -->
                        @can('admin', 'admin')
                            <!-- Dropdown for Admins Only -->
                            <div class="relative hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <button @click="eventDropdownOpen = !eventDropdownOpen"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <span>{{ __('Events') }}</span>
                                    <svg class="ml-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                    </svg>
                                </button>

                                <!-- Dropdown Content -->
                                <div x-show="eventDropdownOpen" @click.away="eventDropdownOpen = false"
                                    class="absolute z-50 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5"
                                    style="display: none;">
                                    <div class="py-1" role="menu" aria-orientation="vertical"
                                        aria-labelledby="options-menu">
                                        <a href="{{ route('events.index') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">{{ __('Events') }}</a>
                                        <a href="{{ route('mentors.index') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">{{ __('Mentors') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @cannot('admin', 'admin')
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <x-nav-link :href="route('eventIndex')" :active="request()->routeIs('eventIndex')">
                                    {{ __('Events') }}
                                </x-nav-link>
                            </div>
                        @endcannot
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('promosis.index')" :active="request()->routeIs('promosis.index')">
                                {{ __('Promosi') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('promosis.mypromote')" :active="request()->is('dashboard')">
                                {{ __('Berita') }}
                            </x-nav-link>
                        </div>

                        @can('multi-role', 'level2|admin|pemimpin')
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <x-nav-link href="/communities" :active="request()->is('communities*')" wire:navigate>
                                    {{ __('Komunitas') }}
                                </x-nav-link>
                            </div>
                        @endcan

                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">

                        @if (Auth::check())
                            <!-- User is logged in -->
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    @can('admin')
                                        <x-dropdown-link :href="route('promosis.pengajuan')">
                                            {{ __('Pengajuan') }}
                                        </x-dropdown-link>
                                    @endcan
                                    <x-dropdown-link :href="route('promosis.promosisaya')">
                                        {{ __('Promosi Saya') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('user.history')">
                                        {{ __('Riwayat Event') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @else
                            <!-- User is not logged in -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <x-nav-link :href="route('login')">
                                    {{ __('Login') }}
                                </x-nav-link>
                                <x-nav-link :href="route('register')">
                                    {{ __('Register') }}
                                </x-nav-link>
                            </div>
                        @endif
                    </div>

                    <!-- Hamburger (Responsive menu) -->
                    <div class="-me-2 flex items-center sm:hidden">

                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Event') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('promosis.index')" :active="request()->is('dashboard')">
                        {{ __('Promosi') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->is('dashboard')">
                        {{ __('Berita') }}
                    </x-responsive-nav-link>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->is('dashboard')">
                            {{ __('Forum') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                    @if (Auth::check())
                        <!-- User is logged in (Responsive) -->
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        @can('admin')
                            <x-dropdown-link :href="route('promosis.pengajuan')" :active="request()->is('dashboard')">
                                {{ __('Pengajuan') }}
                            </x-dropdown-link>
                        @endcan
                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('promosis.mypromote')" :active="request()->is('promosis.promosiku')">
                                {{ __('Promosi Saya') }}
                            </x-responsive-nav-link>

                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    @else
                        <!-- User is not logged in (Responsive) -->
                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('login')">
                                {{ __('Login') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('register')">
                                {{ __('Register') }}
                            </x-responsive-nav-link>
                        </div>
                    @endif
                </div>
            </div>
    </nav>
