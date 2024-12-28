@inject('auth', 'Illuminate\Support\Facades\Auth')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

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
            <a href="{{ route('dashboard.community.index') }}" class="group">
                <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <img src="/Pictures/community.jpg" 
                         alt="CS2 Community" 
                         class="w-full h-48 object-cover">
                    <div class="p-6 bg-orange-600">
                        <h3 class="text-xl font-semibold text-white">Community</h3>
                        <p class="mt-2 text-orange-100">Search for players, newsitems and FAQ</p>
                        <div class="mt-4">
                            <span class="text-sm text-white">
                                Learn more →
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
