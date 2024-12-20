<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="text-center">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Welcome back,</span>
                            <span class="block text-orange-600">{{ Auth::user()->name }}</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl">
                            Start exploring CS2 content and build your personal collection.
                        </p>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Featured Content -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Maps Card -->
                <a href="{{ route('maps.index') }}" class="group">
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('images/cs2/maps/dust2.jpg') }}" 
                             alt="CS2 Maps" 
                             class="w-full h-48 object-cover">
                        <div class="p-6 bg-orange-600">
                            <h3 class="text-xl font-semibold text-white">Maps</h3>
                            <p class="mt-2 text-orange-100">Discover and like your favorite maps.</p>
                            <div class="mt-4">
                                <span class="text-sm text-white">
                                    Your liked maps: 0
                                </span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Weapons Card -->
                <a href="{{ route('weapons.index') }}" class="group">
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('images/cs2/weapons/ak47.png') }}" 
                             alt="CS2 Weapons" 
                             class="w-full h-48 object-cover">
                        <div class="p-6 bg-orange-600">
                            <h3 class="text-xl font-semibold text-white">Weapons</h3>
                            <p class="mt-2 text-orange-100">Browse and track your preferred weapons.</p>
                            <div class="mt-4">
                                <span class="text-sm text-white">
                                    Your liked weapons: 0
                                </span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Community Card -->
                <a href="{{ route('community.index') }}" class="group">
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('images/cs2/community/competitive.jpg') }}" 
                             alt="CS2 Community" 
                             class="w-full h-48 object-cover">
                        <div class="p-6 bg-orange-600">
                            <h3 class="text-xl font-semibold text-white">Community</h3>
                            <p class="mt-2 text-orange-100">Connect with other CS2 players.</p>
                            <div class="mt-4">
                                <span class="text-sm text-white">
                                    Community posts: 0
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
