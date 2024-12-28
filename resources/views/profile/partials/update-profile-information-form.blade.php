<section class="bg-white p-6 rounded-lg shadow">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <div class="mt-6">
        <form id="avatar-form" action="{{ route('profile.avatar') }}" method="post" enctype="multipart/form-data" class="mb-6">
            @csrf
            @method('patch')

            <div class="flex items-center gap-4">
                <div class="relative">
                    @if($user->avatar)
                        <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}'s Profile Picture" 
                             class="w-24 h-24 rounded-full object-cover border-2 border-orange-500">
                    @else
                        <div class="w-24 h-24 rounded-full bg-orange-100 flex items-center justify-center border-2 border-orange-500">
                            <span class="text-2xl font-bold text-orange-600">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                    @endif

                    <div class="absolute bottom-0 right-0">
                        <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*" onchange="document.getElementById('avatar-form').submit();">
                        <label for="avatar" class="cursor-pointer">
                            <div class="rounded-full bg-orange-500 p-2 text-white hover:bg-orange-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                </svg>
                            </div>
                        </label>
                        <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                    </div>
                </div>
            </div>
        </form>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" 
                class="mt-1 block w-full !bg-white border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm text-gray-900" 
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" 
                class="mt-1 block w-full !bg-white border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm text-gray-900" 
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-orange-600 hover:text-orange-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="birthday" :value="__('Birthday')" />
            <x-text-input id="birthday" name="birthday" type="date" 
                class="mt-1 block w-full !bg-white border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm text-gray-900" 
                :value="old('birthday', $user->birthday)" />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div>
            <x-input-label for="about" :value="__('About')" />
            <textarea id="about" name="about" 
                class="mt-1 block w-full !bg-white text-gray-900 border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm" 
                rows="4">{{ old('about', $user->about) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('about')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-orange-600 hover:bg-orange-700">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
