<x-guest-layout>
    <div class="min-h-screen bg-gray-900">
        <!-- Hero Section -->
        <div class="relative py-16 px-4 sm:px-6 lg:px-8">
            <div class="relative max-w-7xl mx-auto">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-100 sm:text-5xl md:text-6xl">
                        Counter-Strike 2
                    </h1>
                    <p class="mt-3 max-w-md mx-auto text-base text-gray-300 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                        The next evolution of the world's most popular tactical shooter game.
                    </p>
                </div>
            </div>
        </div>

        <!-- Featured Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Maps Card -->
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                    <img src="https://via.placeholder.com/600x300" alt="CS2 Maps" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-100">Maps</h3>
                        <p class="mt-2 text-gray-400">Explore classic and new competitive maps in CS2.</p>
                    </div>
                </div>

                <!-- Weapons Card -->
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                    <img src="https://via.placeholder.com/600x300" alt="CS2 Weapons" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-100">Weapons</h3>
                        <p class="mt-2 text-gray-400">Master the arsenal of tactical weapons available in CS2.</p>
                    </div>
                </div>

                <!-- Community Card -->
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                    <img src="https://via.placeholder.com/600x300" alt="CS2 Community" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-100">Community</h3>
                        <p class="mt-2 text-gray-400">Join our growing community of CS2 players.</p>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="mt-16 text-center">
                @auth
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700">
                        Go to Dashboard
                    </a>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700">
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-300 bg-transparent hover:bg-gray-700">
                            Register
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</x-guest-layout> 