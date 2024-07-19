<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">

                                <div>
                                    <img height="100px" width="50px"
                                        src="{{ asset('uploads/avatars/1720967302.jpg') }}" alt="avatar"
                                        class="h-8 w-8 rounded-full object-cover me-2">
                                </div>
                                {{-- @if (Auth::user()->avatar)
                                    <img height="100px" width="50px"
                                        src="{{ asset('uploads/avatars/1720967302.jpg' . Auth::user()->avatar) }}"
                                        alt="avatar" class="h-8 w-8 rounded-full object-cover me-2">
                                @endif --}}
                                <div class="m-5">{{ Auth::user()->name }}</div>

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
                            @if (Auth::user()->hasRole('seller'))
                                <x-responsive-nav-link :href="url('seller/dashboard')">
                                    {{ __('پنل فروشگاه') }}
                                </x-responsive-nav-link>
                            @endif
                            @if (Auth::user()->hasRole('admin'))
                                <x-responsive-nav-link :href="url('admin/dashboard')">
                                    {{ __('پنل ادمین') }}
                                </x-responsive-nav-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    {{ __('خروج از حساب کاربری') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
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
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('پنل کابری') }}
            </h2>

            <div class="list-inline-item ">
                @unless (Auth::user()->hasRole('seller'))
                    <div class="list-inline-item">
                        <a class="btn btn-primary m-3 text-white" href="{{ url('/shops/create') }}"> ساخت فروشگاه </a>
                    </div>
                @endunless <a class="btn btn-primary m-3 text-white" href="{{ url('/') }}">برگشت به صفحه اصلی</a>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    @if (Auth::user()->hasRole('seller'))
                        <x-responsive-nav-link :href="url('seller/dashboard')">
                            {{ __('پنل فروشگاه') }}
                        </x-responsive-nav-link>
                    @endif
                    @if (Auth::user()->hasRole('admin'))
                        <x-responsive-nav-link :href="url('admin/dashboard')">
                            {{ __('پنل ادمین') }}
                        </x-responsive-nav-link>
                    @endif
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('خروج از حساب کاربری') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
</nav>