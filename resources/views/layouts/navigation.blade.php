<nav x-data="{ open: false }" class="bg-orange-600 border-b border-orange-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                            class="text-white hover:text-orange-100"
                            :class="request()->routeIs('dashboard') ? 'border-white' : 'border-transparent'">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                            class="text-white hover:text-orange-100"
                            :class="request()->routeIs('home') ? 'border-white' : 'border-transparent'">
                            {{ __('Home') }}
                        </x-nav-link>
                    @endauth
                    <x-nav-link :href="route('weapons.index')" :active="request()->routeIs('weapons.index')"
                        class="text-white hover:text-orange-100"
                        :class="request()->routeIs('weapons.index') ? 'border-white' : 'border-transparent'">
                        {{ __('Weapons') }}
                    </x-nav-link>
                    <x-nav-link :href="route('community.index')" :active="request()->routeIs('community.*')"
                        class="text-white hover:text-orange-100"
                        :class="request()->routeIs('community.*') ? 'border-white' : 'border-transparent'">
                        {{ __('Community') }}
                    </x-nav-link>
                    @auth
                        @if(!Auth::user()->is_admin)
                            <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.*')"
                                class="text-white hover:text-orange-100"
                                :class="request()->routeIs('contact.*') ? 'border-white' : 'border-transparent'">
                                {{ __('My Messages') }}
                            </x-nav-link>
                        @endif
                    @endauth
                    @if(Auth::user() && Auth::user()->is_admin)
                        <x-nav-link :href="route('admin.contacts.index')" :active="request()->routeIs('admin.contacts.*')"
                            class="text-white hover:text-orange-100"
                            :class="request()->routeIs('admin.contacts.*') ? 'border-white' : 'border-transparent'">
                            {{ __('Contact Messages') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-orange-100 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
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
                    <div class="space-x-4">
                        <button onclick="openLoginModal()" 
                            class="text-white hover:text-orange-100">
                            Login
                        </button>
                        <button onclick="openRegisterModal()" 
                            class="text-white hover:text-orange-100">
                            Register
                        </button>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-orange-100 hover:bg-orange-700 focus:outline-none focus:bg-orange-700 focus:text-orange-100 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="text-white hover:text-orange-100 hover:bg-orange-700">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')"
                    class="text-white hover:text-orange-100 hover:bg-orange-700">
                    {{ __('Home') }}
                </x-responsive-nav-link>
            @endauth
            <x-responsive-nav-link :href="route('weapons.index')" :active="request()->routeIs('weapons.*')"
                class="text-white hover:text-orange-100 hover:bg-orange-700">
                {{ __('Weapons') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('community.index')" :active="request()->routeIs('community.*')"
                class="text-white hover:text-orange-100 hover:bg-orange-700">
                {{ __('Community') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-orange-700">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-orange-200">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')"
                        class="text-white hover:text-orange-100 hover:bg-orange-700">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                            this.closest('form').submit();"
                            class="text-white hover:text-orange-100 hover:bg-orange-700">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-orange-700">
                <div class="space-y-1">
                    <button onclick="openLoginModal()" 
                        class="w-full text-left px-4 py-2 text-white hover:text-orange-100 hover:bg-orange-700">
                        Login
                    </button>
                    <button onclick="openRegisterModal()" 
                        class="w-full text-left px-4 py-2 text-white hover:text-orange-100 hover:bg-orange-700">
                        Register
                    </button>
                </div>
            </div>
        @endauth
    </div>
</nav>
