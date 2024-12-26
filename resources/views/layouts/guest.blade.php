<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CS2 Community') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="bg-white">
            <!-- Navigation -->
            <nav class="bg-white border-b border-orange-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <img src="https://cdn.cloudflare.steamstatic.com/apps/csgo/images/csgo_react/global/logo_cs.svg" 
                                     alt="CS2 Logo" 
                                     class="h-8 w-auto">
                            </div>
                        </div>
                        
                        <!-- Navigation Links -->
                        <div class="hidden sm:flex sm:space-x-8 sm:items-center">
                            <a href="#" class="text-gray-900 hover:text-orange-600 px-3 py-2 text-sm font-medium">Maps</a>
                            <a href="#" class="text-gray-900 hover:text-orange-600 px-3 py-2 text-sm font-medium">Weapons</a>
                            <a href="{{ route('community.index') }}" 
                               class="text-gray-900 hover:text-orange-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('community.*') ? 'border-b-2 border-orange-500' : '' }}">
                                Community
                            </a>
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-orange-600 px-3 py-2 text-sm font-medium">Dashboard</a>
                            @else
                                <button onclick="openLoginModal()" 
                                        class="text-gray-800 hover:text-orange-600 px-3 py-2">
                                    Login
                                </button>
                                <button onclick="openRegisterModal()" 
                                        class="text-gray-800 hover:text-orange-600 px-3 py-2">
                                    Register
                                </button>   
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            {{ $slot }}
        </div>
    </body>
</html>
