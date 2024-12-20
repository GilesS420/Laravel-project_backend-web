<x-guest-layout>
    <!-- Main container with background -->
    <div class="min-h-screen relative" style="background: url('/Pictures/background.jpg') center top -100px/cover no-repeat fixed;">
        <!-- Optional dark overlay for better text readability -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        
        <!-- Content -->
        <div class="relative z-10">
            <!-- Hero Section -->
            <div class="max-w-7xl mx-auto">
                <div class="pt-20 pb-8 sm:pt-24 sm:pb-16 md:pt-32 lg:pt-40 lg:pb-28 xl:pb-32">
                    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="text-center">
                            <h1 class="text-5xl tracking-tight font-extrabold text-white sm:text-6xl md:text-7xl lg:text-8xl">
                                <span class="block mb-4">Welcome to</span>
                                <span class="block text-orange-500">Counter-Strike 2</span>
                            </h1>
                        </div>
                    </main>
                </div>
            </div>

            <!-- Cards Section -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Maps Card -->
                    <a href="{{ route('maps.index') }}" class="group">
                        <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <img src="/Pictures/maps.jpg" 
                                 alt="CS2 Maps" 
                                 class="w-full h-48 object-cover">
                            <div class="p-6 bg-orange-600">
                                <h3 class="text-xl font-semibold text-white">Maps</h3>
                                <p class="mt-2 text-orange-100">Explore classic and new competitive maps in CS2.</p>
                                <div class="mt-4">
                                    <span class="text-sm text-white">
                                        Learn more →
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Weapons Card -->
                    <a href="{{ route('weapons.index') }}" class="group">
                        <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <img src="/Pictures/weapons.jpg" 
                                 alt="CS2 Weapons" 
                                 class="w-full h-48 object-cover">
                            <div class="p-6 bg-orange-600">
                                <h3 class="text-xl font-semibold text-white">Weapons</h3>
                                <p class="mt-2 text-orange-100">Master the arsenal of tactical weapons available in CS2.</p>
                                <div class="mt-4">
                                    <span class="text-sm text-white">
                                        Learn more →
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Community Card -->
                    <a href="{{ route('community.index') }}" class="group">
                        <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <img src="/Pictures/community.jpg" 
                                 alt="CS2 Community" 
                                 class="w-full h-48 object-cover">
                            <div class="p-6 bg-orange-600">
                                <h3 class="text-xl font-semibold text-white">Community</h3>
                                <p class="mt-2 text-orange-100">Connect with other CS2 players.</p>
                                <div class="mt-4">
                                    <span class="text-sm text-white">
                                        Learn more →
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Call to Action -->
                <div class="mt-12 text-center">
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
                               class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-900 bg-white hover:bg-gray-50">
                                Register
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-guest-layout> 