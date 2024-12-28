<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <h2 class="text-2xl font-bold mb-6">CS2 Weapons</h2>

                    @if($weapons->isEmpty())
                        <p class="text-gray-500">No weapons available at this time.</p>
                    @else
                        @foreach($weapons as $type => $weaponGroup)
                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4 text-gray-800 capitalize">{{ $type }}s</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($weaponGroup as $weapon)
                                        <div class="bg-gray-50 rounded-lg p-6 relative hover:shadow-lg transition-shadow">
                                            <!-- Image Container -->
                                            <div class="mb-4 h-48 flex items-center justify-center bg-gradient-to-b from-gray-800 to-gray-900 rounded-lg overflow-hidden">
                                                @if($weapon->image)
                                                    <img src="{{ url($weapon->image) }}" 
                                                         alt="{{ $weapon->name }}"
                                                         class="h-40 w-auto object-contain mix-blend-normal filter drop-shadow-lg">
                                                @else
                                                    <div class="text-gray-400">No image available</div>
                                                @endif
                                            </div>

                                            <!-- Weapon Details -->
                                            <div class="space-y-3">
                                                <h4 class="text-lg font-medium text-gray-900">{{ $weapon->name }}</h4>
                                                
                                                <div class="flex justify-between items-center">
                                                    <span class="text-gray-600">Price:</span>
                                                    <span class="font-medium text-green-600">${{ number_format($weapon->price) }}</span>
                                                </div>
                                                
                                                <div class="flex justify-between items-center">
                                                    <span class="text-gray-600">Difficulty:</span>
                                                    <span class="font-medium capitalize px-2 py-1 rounded-full text-sm
                                                        {{ $weapon->difficulty === 'easy' ? 'bg-green-100 text-green-800' : '' }}
                                                        {{ $weapon->difficulty === 'medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                        {{ $weapon->difficulty === 'hard' ? 'bg-red-100 text-red-800' : '' }}">
                                                        {{ $weapon->difficulty }}
                                                    </span>
                                                </div>

                                                @if($weapon->description)
                                                    <p class="text-sm text-gray-600 mt-2">{{ $weapon->description }}</p>
                                                @endif
                                            </div>

                                            <!-- Favorite Button -->
                                            @auth
                                                <form action="{{ route('weapons.toggle-favorite', $weapon) }}" 
                                                      method="POST" 
                                                      class="absolute top-4 right-4">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="text-gray-400 hover:text-yellow-400 transition-colors">
                                                        <svg class="w-6 h-6 {{ $weapon->isFavoritedBy(auth()->user()) ? 'text-yellow-400' : '' }}" 
                                                             fill="currentColor" 
                                                             viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endauth
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
</x-app-layout> 