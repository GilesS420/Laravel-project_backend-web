<div id="register-modal" class="fixed inset-0 z-50 hidden">
    <!-- Blurred backdrop -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
    
    <!-- Modal content -->
    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-md">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6">
            <!-- Close button -->
            <button onclick="closeRegisterModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Title -->
            <h2 class="text-2xl font-bold mb-6 text-center dark:text-white">Register</h2>

            <div id="ajax-validation-errors" class="mb-4 hidden">
                <div class="font-medium text-red-600 dark:text-red-400"></div>
                <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400"></ul>
            </div>

            <form method="POST" action="{{ route('register') }}" onsubmit="handleRegistration(event)">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" onkeyup="checkPassword(this.value)" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    
                    <!-- Add password requirements with check indicators -->
                    <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Password must contain:
                        <ul class="list-disc list-inside">
                            <li id="length-check" class="flex items-center gap-2">
                                <span class="text-red-500" id="length-icon">✕</span>
                                At least 8 characters
                            </li>
                            <li id="uppercase-check" class="flex items-center gap-2">
                                <span class="text-red-500" id="uppercase-icon">✕</span>
                                At least one uppercase letter
                            </li>
                            <li id="lowercase-check" class="flex items-center gap-2">
                                <span class="text-red-500" id="lowercase-icon">✕</span>
                                At least one lowercase letter
                            </li>
                            <li id="number-check" class="flex items-center gap-2">
                                <span class="text-red-500" id="number-icon">✕</span>
                                At least one number
                            </li>
                            <li id="special-check" class="flex items-center gap-2">
                                <span class="text-red-500" id="special-icon">✕</span>
                                At least one special character
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="#" onclick="openLoginModal(); closeRegisterModal(); return false;">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div> 

<script>
function checkPassword(password) {
    // Check length
    const lengthValid = password.length >= 8;
    document.getElementById('length-icon').textContent = lengthValid ? '✓' : '✕';
    document.getElementById('length-icon').className = lengthValid ? 'text-green-500' : 'text-red-500';

    // Check uppercase
    const uppercaseValid = /[A-Z]/.test(password);
    document.getElementById('uppercase-icon').textContent = uppercaseValid ? '✓' : '✕';
    document.getElementById('uppercase-icon').className = uppercaseValid ? 'text-green-500' : 'text-red-500';

    // Check lowercase
    const lowercaseValid = /[a-z]/.test(password);
    document.getElementById('lowercase-icon').textContent = lowercaseValid ? '✓' : '✕';
    document.getElementById('lowercase-icon').className = lowercaseValid ? 'text-green-500' : 'text-red-500';

    // Check numbers
    const numberValid = /[0-9]/.test(password);
    document.getElementById('number-icon').textContent = numberValid ? '✓' : '✕';
    document.getElementById('number-icon').className = numberValid ? 'text-green-500' : 'text-red-500';

    // Check special characters
    const specialValid = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    document.getElementById('special-icon').textContent = specialValid ? '✓' : '✕';
    document.getElementById('special-icon').className = specialValid ? 'text-green-500' : 'text-red-500';
}

function handleRegistration(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    const errorDiv = document.getElementById('ajax-validation-errors');
    const errorList = errorDiv.querySelector('ul');
    const errorTitle = errorDiv.querySelector('div');

    // Clear previous errors
    errorDiv.classList.add('hidden');
    errorList.innerHTML = '';
    errorTitle.textContent = '';

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'same-origin'
    })
    .then(async response => {
        if (response.redirected) {
            window.location.href = response.url;
            return;
        }
        
        const data = await response.json();
        throw data;
    })
    .catch(error => {
        errorDiv.classList.remove('hidden');
        
        if (error.errors) {
            // Validation errors
            errorTitle.textContent = 'Whoops! Something went wrong.';
            Object.keys(error.errors).forEach(field => {
                error.errors[field].forEach(message => {
                    const li = document.createElement('li');
                    li.textContent = message;
                    errorList.appendChild(li);
                });
            });
        } else {
            // Generic error
            errorTitle.textContent = 'An error occurred. Please try again.';
        }
    });
}
</script> 