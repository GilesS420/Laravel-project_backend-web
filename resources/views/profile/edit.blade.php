<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header class="flex items-center gap-4">
                            <div class="relative">
                                @if($user->avatar)
                                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}'s Profile Picture" 
                                         class="w-24 h-24 rounded-full object-cover border-2 border-indigo-500">
                                @else
                                    <div class="w-24 h-24 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center border-2 border-indigo-500">
                                        <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-300">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                                
                                <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" 
                                      class="absolute -bottom-2 -right-2">
                                    @csrf
                                    @method('patch')
                                    <label for="avatar" class="cursor-pointer">
                                        <div class="rounded-full bg-indigo-500 p-2 text-white hover:bg-indigo-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <input type="file" id="avatar" name="avatar" class="hidden" 
                                               onchange="this.form.submit()" accept="image/*">
                                    </label>
                                </form>
                            </div>
                            
                            <div>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ $user->name }}
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $user->email }}
                                </p>
                                @if($user->is_admin)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                        Admin
                                    </span>
                                @endif
                            </div>
                        </header>

                        <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                                             :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" 
                                             :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="birthday" :value="__('Birthday')" />
                                <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" 
                                             :value="old('birthday', $user->birthday)" />
                                <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
                            </div>

                            <div>
                                <x-input-label for="about" :value="__('About')" />
                                <textarea id="about" name="about" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" 
                                    rows="4">{{ old('about', $user->about) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('about')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
