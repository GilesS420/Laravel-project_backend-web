<div class="p-6">
    <div class="flex items-center space-x-6">
        @if($user->avatar)
            <img src="{{ Storage::url($user->avatar) }}" 
                 alt="{{ $user->name }}'s Profile Picture"
                 class="h-32 w-32 rounded-full object-cover border-4 border-orange-500">
        @else
            <div class="h-32 w-32 rounded-full bg-orange-100 flex items-center justify-center border-4 border-orange-500">
                <span class="text-4xl font-medium text-orange-600">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </span>
            </div>
        @endif
        
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                {{ $user->name }}
            </h1>
            @if($user->is_admin)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                    Admin
                </span>
            @endif
        </div>
    </div>

    @if($user->about)
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">About</h2>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                <p class="text-gray-600">{{ $user->about }}</p>
            </div>
        </div>
    @endif

    @if($user->birthday)
        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Birthday</h2>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                <p class="text-gray-600">
                    {{ \Carbon\Carbon::parse($user->birthday)->format('F j, Y') }}
                </p>
            </div>
        </div>
    @endif

    @auth
        @if(Auth::id() === $user->id)
            <div class="mt-6">
                <a href="{{ route('profile.edit') }}" 
                   class="inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 transition-colors duration-200">
                    Edit Profile
                </a>
            </div>
        @endif
    @endauth
</div> 