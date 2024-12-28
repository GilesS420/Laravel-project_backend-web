<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Contact Message</h2>
                        <a href="{{ route('admin.contacts.index') }}" 
                           class="text-orange-600 hover:text-orange-900">← Back to list</a>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <div class="mb-4">
                            <div class="text-sm text-gray-500">From</div>
                            <div class="font-medium">
                                {{ $contact->user ? "{$contact->user->name} ({$contact->user->email})" : 'Anonymous' }}
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="text-sm text-gray-500">Date</div>
                            <div>{{ $contact->created_at->format('F j, Y H:i') }}</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-sm text-gray-500">Subject</div>
                            <div class="font-medium">{{ $contact->subject }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Message</div>
                            <div class="mt-2 whitespace-pre-wrap">{{ $contact->message }}</div>
                        </div>
                    </div>

                    @if($contact->is_answered)
                        <div class="bg-green-50 rounded-lg p-6 mb-6">
                            <h3 class="font-medium text-green-900 mb-2">Your Response</h3>
                            <div class="whitespace-pre-wrap text-green-800">{{ $contact->admin_response }}</div>
                        </div>
                    @endif

                    <div class="flex justify-end space-x-4 mb-4">
                        <x-secondary-button 
                            type="button"
                            onclick="showFaqModal()"
                            class="bg-blue-600 hover:bg-blue-700 text-white">
                            Convert to FAQ
                        </x-secondary-button>

                        <form method="POST" 
                              action="{{ route('admin.contacts.destroy', $contact) }}" 
                              class="inline-block"
                              onsubmit="return confirm('Are you sure you want to delete this contact?')">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit">
                                Delete
                            </x-danger-button>
                        </form>
                    </div>

                    <form method="POST" 
                          action="{{ route('admin.contacts.respond', $contact) }}" 
                          class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="response" :value="__('Your Response')" />
                            <textarea id="response" 
                                name="response" 
                                rows="6" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                required>{{ old('response', $contact->admin_response) }}</textarea>
                            <x-input-error :messages="$errors->get('response')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button class="bg-orange-600 hover:bg-orange-700">
                                {{ __('Send Response') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.contacts._faq-modal')

    <script>
        function showFaqModal() {
            document.getElementById('faqModal').classList.remove('hidden');
        }

        function closeFaqModal() {
            document.getElementById('faqModal').classList.add('hidden');
        }
    </script>
</x-app-layout> 