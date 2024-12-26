<div id="create-user-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
    
    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-md">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6">
            <button onclick="closeCreateUserModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-2xl font-bold mb-6 text-center dark:text-white">Create New User</h2>

            @if ($errors->any())
                <div class="mb-4">
                    <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <div>
                    <x-input-label for="create_name" :value="__('Name')" />
                    <x-text-input id="create_name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                </div>

                <div class="mt-4">
                    <x-input-label for="create_email" :value="__('Email')" />
                    <x-text-input id="create_email" class="block mt-1 w-full" type="email" name="email" required />
                </div>

                <div class="mt-4">
                    <x-input-label for="create_password" :value="__('Password')" />
                    <x-text-input id="create_password" class="block mt-1 w-full" type="password" name="password" required />
                </div>

                <div class="mt-4">
                    <x-input-label for="create_password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="create_password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                </div>

                <div class="block mt-4">
                    <label for="is_admin" class="inline-flex items-center">
                        <input id="is_admin" type="checkbox" name="is_admin" value="1" class="rounded">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Admin User') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3">
                        {{ __('Create User') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCreateUserModal() {
    document.getElementById('create-user-modal').classList.remove('hidden');
}

function closeCreateUserModal() {
    document.getElementById('create-user-modal').classList.add('hidden');
    document.getElementById('create-user-form').reset();
}
</script> 