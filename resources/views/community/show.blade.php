<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex items-center space-x-6">
                        @if($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" 
                                 alt="{{ $user->name }}'s Profile Picture"
                                 class="h-32 w-32 rounded-full object-cover">
                        @else
                            <div class="h-32 w-32 rounded-full bg-indigo-100 flex items-center justify-center">
                                <span class="text-4xl font-medium text-indigo-600">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                        
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                                {{ $user->name }}
                            </h1>
                            @if($user->is_admin)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                    Admin
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($user->about)
                        <div class="mt-8">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">About me</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $user->about }}</p>
                        </div>
                    @endif

                    @if($user->birthday)
                        <div class="mt-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Birthday</h2>
                            <p class="text-gray-600 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($user->birthday)->format('F j, Y') }}
                            </p>
                        </div>
                    @endif

                    @auth
                        @if(Auth::id() === $user->id)
                            <div class="mt-6">
                                <a href="{{ route('profile.edit') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                    Edit Profile
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 