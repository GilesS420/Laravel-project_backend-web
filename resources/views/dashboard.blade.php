@inject('auth', 'Illuminate\Support\Facades\Auth')


<x-app-layout>
    <div class="min-h-screen relative" style="background: url('/Pictures/background.jpg') center top -100px/cover no-repeat fixed;">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        
        <!-- Content -->
        <div class="relative z-10">
            <div class="max-w-7xl mx-auto">
                <div class="pt-20 pb-8 sm:pt-24 sm:pb-16">
                    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="text-center">
                            <h1 class="text-4xl tracking-tight font-bold text-white sm:text-5xl">
                                <span class="block">Welcome back to CS2</span>
                                <span class="block text-orange-500">{{ Auth::user()->name }}</span>
                            </h1>
                        </div>
                    </main>
                </div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
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
                                <p class="mt-2 text-orange-100">Search for players, the latest news and Frequently Asked Questions</p>
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
        </div>
    </div>
</x-app-layout>
