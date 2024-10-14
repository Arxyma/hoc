<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @if (isset($thread_title))
            {{ $thread_title }} —
        @endif
        @if (isset($category))
            {{ $category->title }} —
        @endif
        {{ trans('forum::general.home_title') }}
    </title>

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @vite(['resources/forum/blade-tailwind/css/forum.css', 'resources/forum/blade-tailwind/js/forum.js'])
</head>

<body class="forum bg-gray-100">
    <nav class="v-navbar bg-white shadow py-4 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <div class="container mx-auto px-4 md:flex md:items-center md:gap-4">
            <div class="flex justify-between items-center">
                {{-- <a class="text-lg font-semibold" href="{{ url(config('forum.frontend.router.prefix')) }}">Hall of
                    Community</a> --}}
                <x-nav-link class="text-lg font-semibold" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Hall of Community') }}
                </x-nav-link>
                <button class="navbar-toggler block md:hidden border rounded-md px-2 py-1" type="button"
                    :class="{ collapsed: isCollapsed }" @click="isCollapsed = !isCollapsed">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="navbar-toggler-icon w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            <div class="grow justify-between navbar-collapse"
                :class="{ 'flex flex-col': !isCollapsed, 'hidden md:flex': isCollapsed }">
                <ul class="flex flex-col md:flex-row gap-3 mb-4 md:mb-0">
                    <li>
                        <a class="text-gray-500 hover:text-gray-800"
                            href="{{ url(config('forum.frontend.router.prefix')) }}">{{ trans('forum::general.index') }}</a>
                    </li>
                    <li>
                        <a class="text-gray-500 hover:text-gray-800"
                            href="{{ route('forum.recent') }}">{{ trans('forum::threads.recent') }}</a>
                    </li>
                    @auth
                        <li>
                            <a class="text-gray-500 hover:text-gray-800"
                                href="{{ route('forum.unread') }}">{{ trans('forum::threads.unread_updated') }}</a>
                        </li>
                    @endauth
                    @can('moveCategories')
                        <li>
                            <a class="text-gray-500 hover:text-gray-800"
                                href="{{ route('forum.category.manage') }}">{{ trans('forum::general.manage') }}</a>
                        </li>
                    @endcan
                </ul>
                <ul class="navbar-nav flex gap-4 flex-col md:flex-row">
                    <!-- Desktop Dark/Light Mode Toggle -->
                    <button id="theme-toggle" type="button"
                        class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    @if (Auth::check())
                        <li class="nav-item dropdown relative">
                            <a class="dropdown-toggle text-gray-500 flex items-center gap-1" href="#"
                                id="navbarDropdownMenuLink" @click="isUserDropdownCollapsed = !isUserDropdownCollapsed">
                                {{ $username }}

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </a>
                            <div class="border absolute left-0 bg-white rounded-md w-44 divide-y"
                                :class="{ hidden: isUserDropdownCollapsed }" aria-labelledby="navbarDropdownMenuLink">
                                <a class="block px-4 py-2" href="{{ url('/logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Log out
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">Log in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/register') }}">Register</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div id="main" class="container mx-auto p-4">
        @include ('forum::partials.breadcrumbs')
        @include ('forum::partials.alerts')

        @yield('content')
    </div>

    @yield('footer')

    <script>
        window.defaultCategoryColor = '{{ config('forum.frontend.default_category_color') }}';
    </script>
</body>

</html>
