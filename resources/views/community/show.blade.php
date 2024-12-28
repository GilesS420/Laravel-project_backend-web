<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $user->name }}'s Profile</h2>

                    <!-- User Information Section -->
                    <div class="mb-8">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-lg font-semibold mb-2 text-gray-900">Contact Information</h3>
                                    <p><span class="text-gray-600">Email:</span> {{ $user->email }}</p>
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold mb-2 text-gray-900">Personal Information</h3>
                                    <p><span class="text-gray-600">Birthday:</span> {{ $user->birthday }}</p>
                                </div>

                                @if($user->about)
                                    <div class="col-span-2">
                                        <h3 class="text-lg font-semibold mb-2 text-gray-900">About Me</h3>
                                        <p class="text-gray-700">{{ $user->about }}</p>
                                    </div>
                                @endif

                                @if($user->is_admin)
                                    <div class="col-span-2">
                                        <span class="bg-orange-100 text-orange-800 text-xs font-medium px-2.5 py-0.5 rounded">Admin</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Favorite Weapons Section -->
                    <div class="mt-8">
                        <h3 class="text-2xl font-semibold mb-4 text-gray-900">Favorite Weapons</h3>
                        
                        @if($favoriteWeapons->isEmpty())
                            <p class="text-gray-500">No favorite weapons yet.</p>
                        @else
                            @foreach($favoriteWeapons as $type => $weapons)
                                <div class="mb-6">
                                    <h4 class="text-lg font-medium mb-3 text-gray-900 capitalize">{{ $type }}s</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach($weapons as $weapon)
                                            <div class="bg-gray-50 rounded-lg p-4 relative hover:shadow-lg transition-shadow">
                                                <!-- Image Container -->
                                                <div class="mb-4 h-32 flex items-center justify-center bg-gradient-to-b from-gray-800 to-gray-900 rounded-lg overflow-hidden">
                                                    @if($weapon->image)
                                                        <img src="{{ url($weapon->image) }}" 
                                                             alt="{{ $weapon->name }}"
                                                             class="h-24 w-auto object-contain mix-blend-normal filter drop-shadow-lg">
                                                    @else
                                                        <div class="text-gray-400">No image available</div>
                                                    @endif
                                                </div>

                                                <!-- Weapon Details -->
                                                <div class="space-y-2">
                                                    <h5 class="font-medium text-gray-900">{{ $weapon->name }}</h5>
                                                    <div class="flex justify-between items-center text-sm">
                                                        <span class="text-gray-600">Price:</span>
                                                        <span class="font-medium text-orange-600">${{ number_format($weapon->price) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 