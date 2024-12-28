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
                    <p class="text-gray-500>">Add the weapon to your public profile by clicking the star</p>
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
                                                      class="absolute top-1 right-1">
                                                    @csrf
                                                    <button type="submit" 
                                                            title="{{ $weapon->isFavoritedBy(auth()->user()) ? 'Remove from favorites' : 'Add to favorites'  }} "
                                                            class="transition-colors">
                                                        <svg class="w-6 h-6 {{ $weapon->isFavoritedBy(auth()->user()) ? 'text-orange-400' : 'text-gray-300' }} hover:text-orange-400"
                                                             xmlns="http://www.w3.org/2000/svg" 
                                                             viewBox="0 0 24 24" 
                                                             fill="currentColor">
                                                            <path fill-rule="evenodd" 
                                                                  d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" 
                                                                  clip-rule="evenodd" />
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