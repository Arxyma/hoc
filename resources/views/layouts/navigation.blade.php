<nav x-data="{ open: false, eventDropdownOpen: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-14 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                @can('pimpinan')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('pimpinan.dashboard')" :active="request()->routeIs('pimpinan.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                @endcan

                <!-- Navigation Links -->
                @can('admin', 'admin')
                    <!-- Dropdown for Admins Only -->
                    <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex cursor-pointer">
                        <div class="hs-dropdown relative z-100 inline-flex">
                            <x-nav-link id="hs-dropdown-default" type="button" class="hs-dropdown-toggle flex gap-2"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown" :active="request()->routeIs('events.index') || request()->routeIs('mentors.index')">
                                {{ __('Events') }}
                                <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </x-nav-link>

                            <div class="hs-dropdown-menu absolute z-[1050] transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                                role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                                <div class="p-1 space-y-0.5">
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        href="{{ route('events.index') }}">
                                        {{ __('Events') }}
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        href="{{ route('mentors.index') }}">
                                        {{ __('Mentors') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan

                @cannot('multi-role', 'admin|pimpinan')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('eventIndex')" :active="request()->routeIs('eventIndex')">
                            {{ __('Events') }}
                        </x-nav-link>
                    </div>
                @endcannot

                @cannot('pimpinan')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('promosis.index')" :active="request()->routeIs('promosis.index')">
                            {{ __('Promosi') }}
                        </x-nav-link>
                    </div>
                @endcannot

                @cannot('multi-role', 'admin|pimpinan')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('beritaIndex')" :active="request()->Routeis('beritaIndex')">
                            {{ __('Berita') }}
                        </x-nav-link>
                    </div>
                @endcannot

                @can('admin')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('berita.index')" :active="request()->Routeis('berita.index')">
                            {{ __('Berita') }}
                        </x-nav-link>
                    </div>
                @endcan

                @can('multi-role', 'level2|admin')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="/communities" :active="request()->is('communities*')" wire:navigate>
                            {{ __('Komunitas') }}
                        </x-nav-link>
                    </div>
                @endcan
                @can('admin')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('membership.index')" :active="request()->Routeis('membership.index')">
                            {{ __('Membership') }}
                        </x-nav-link>
                    </div>
                @endcan
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex gap-8 items-center">
                @if (Auth::check())
                    <!-- User is logged in -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <img id="foto-profil" src="{{ Auth::user()->profileImageUrl }}" alt="Foto Profil"
                                    class="w-9 h-9 mr-2 rounded-full" />
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
                            @cannot('pimpinan')
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @can('admin')
                                    <x-dropdown-link :href="route('promosis.pengajuan')">
                                        {{ __('Pengajuan Promosi') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('promosis.semuapromosi')">
                                        {{ __('Semua Promosi') }}
                                    </x-dropdown-link>
                                @elsecan('level2')
                                    <x-dropdown-link :href="route('promosis.promosisaya')">
                                        {{ __('Promosi Saya') }}
                                    </x-dropdown-link>
                                @endcan

                                <x-dropdown-link :href="route('user.history')">
                                    {{ __('Riwayat Event') }}
                                </x-dropdown-link>
                            @endcannot

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
                    <div class="flex h-full">
                        <x-nav-link :href="route('login')">
                            {{ __('Login') }}
                        </x-nav-link>
                    </div>
                    <div class="flex h-full">
                        <x-nav-link :href="route('register')">
                            {{ __('Register') }}
                        </x-nav-link>
                    </div>
                @endif
            </div>

            <!-- Hamburger (Responsive menu) -->
            <div class="-me-2 flex items-center sm:hidden">
                @guest
                    <!-- User not logged in -->
                    <div class="flex gap-4 items-center">
                        <x-nav-link :href="route('login')">
                            {{ __('Login') }}
                        </x-nav-link>
                        <x-nav-link :href="route('register')">
                            {{ __('Register') }}
                        </x-nav-link>
                    </div>
                @endguest
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @can('pimpinan')
                <x-responsive-nav-link :href="route('pimpinan.dashboard')" :active="request()->routeIs('pimpinan.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endcan

            @cannot('multi-role', 'admin|pimpinan')
                <x-responsive-nav-link :href="route('eventIndex')" :active="request()->routeIs('eventIndex')">
                    {{ __('Events') }}
                </x-responsive-nav-link>
            @endcannot

            <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                {{ __('Events') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('mentors.index')" :active="request()->routeIs('mentors.index')">
                {{ __('Mentors') }}
            </x-responsive-nav-link>

            @cannot('pimpinan')
                <x-responsive-nav-link :href="route('promosis.index')" :active="request()->routeIs('promosis.index')">
                    {{ __('Promosi') }}
                </x-responsive-nav-link>
            @endcannot

            @cannot('multi-role', 'admin|pimpinan')
                <x-responsive-nav-link :href="route('beritaIndex')" :active="request()->Routeis('beritaIndex')">
                    {{ __('Berita') }}
                </x-responsive-nav-link>
            @endcannot

            @can('admin')
                <x-responsive-nav-link :href="route('berita.index')" :active="request()->Routeis('berita.index')">
                    {{ __('Berita') }}
                </x-responsive-nav-link>
            @endcan

            @can('multi-role', 'level2|admin')
                <x-responsive-nav-link href="/communities" :active="request()->is('communities*')" wire:navigate>
                    {{ __('Komunitas') }}
                </x-responsive-nav-link>
            @endcan
            @can('admin')
                <x-responsive-nav-link :href="route('membership.index')" :active="request()->Routeis('membership.index')">
                    {{ __('Membership') }}
                </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-3 pb-1 border-t border-gray-200 dark:border-gray-600">
            @if (Auth::check())
                <!-- User is logged in (Responsive) -->
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    @cannot('pimpinan')
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        @can('admin')
                            <x-responsive-nav-link :href="route('promosis.pengajuan')">
                                {{ __('Pengajuan Promosi') }}
                            </x-responsive-nav-link>

                            <x-responsive-nav-link :href="route('promosis.semuapromosi')">
                                {{ __('Semua Promosi') }}
                            </x-responsive-nav-link>
                        @elsecan('level2')
                            <x-responsive-nav-link :href="route('promosis.promosisaya')">
                                {{ __('Promosi Saya') }}
                            </x-responsive-nav-link>
                        @endcan

                        <x-responsive-nav-link :href="route('user.history')">
                            {{ __('Riwayat Event') }}
                        </x-responsive-nav-link>
                    @endcannot

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
            @endif
        </div>
    </div>
</nav>
