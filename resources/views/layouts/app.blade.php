<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" data-is-admin="{{ json_encode(Auth::check() && Auth::user()->is_admin) }}">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @include('auth._login-modal')

        <!-- Add Modal Control Scripts -->
        <script>
            function openLoginModal() {
                document.getElementById('login-modal').classList.remove('hidden');
                document.getElementById('register-modal').classList.add('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeLoginModal() {
                document.getElementById('login-modal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            function openRegisterModal() {
                document.getElementById('register-modal').classList.remove('hidden');
                document.getElementById('login-modal').classList.add('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeRegisterModal() {
                document.getElementById('register-modal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            // Close modals when clicking outside
            window.onclick = function(event) {
                const loginModal = document.getElementById('login-modal');
                const registerModal = document.getElementById('register-modal');
                
                if (event.target === loginModal) {
                    closeLoginModal();
                }
                if (event.target === registerModal) {
                    closeRegisterModal();
                }
            };
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Intercept clicks on protected routes
                document.querySelectorAll('a[href*="weapons"]').forEach(link => {
                    link.addEventListener('click', function(e) {
                        if (!{{ auth()->check() ? 'true' : 'false' }}) {
                            e.preventDefault();
                            openLoginModal();
                        }
                    });
                });

                // Add fetch error handler for AJAX requests
                window.addEventListener('fetch', function(event) {
                    event.response.then(response => {
                        if (response.status === 401) {
                            openLoginModal();
                        }
                    });
                });
            });
        </script>
    </body>
</html>
