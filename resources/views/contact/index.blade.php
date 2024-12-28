<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">My Messages To Admins</h2>
                        <a href="{{ route('contact.create') }}" 
                           class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-md">
                            New Message
                        </a>
                    </div>

                    @if($contacts->isEmpty())
                        <p class="text-gray-500">You haven't sent any messages yet.</p>
                    @else
                        <div class="space-y-6">
                            @foreach($contacts as $contact)
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <div class="text-sm text-gray-500">Sent on</div>
                                            <div>{{ $contact->created_at->format('F j, Y H:i') }}</div>
                                        </div>
                                        @if($contact->is_converted_to_faq)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                Added to FAQ
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="mb-4">
                                        <div class="text-sm text-gray-500">Subject</div>
                                        <div class="font-medium">{{ $contact->subject }}</div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <div class="text-sm text-gray-500">Your Message</div>
                                        <div class="mt-2 whitespace-pre-wrap">{{ $contact->message }}</div>
                                    </div>

                                    @if($contact->is_answered)
                                        <div class="mt-6 bg-green-50 rounded-lg p-4">
                                            <div class="text-sm text-green-700 font-medium mb-2">Admin Response</div>
                                            <div class="text-green-800 whitespace-pre-wrap">{{ $contact->admin_response }}</div>
                                            <div class="text-sm text-green-600 mt-2">
                                                Answered on {{ $contact->updated_at->format('F j, Y H:i') }}
                                            </div>
                                        </div>
                                        
                                        @if($contact->is_converted_to_faq)
                                            <div class="mt-4 text-sm">
                                                <a href="{{ route('community.index', ['tab' => 'faq']) }}" 
                                                   class="text-blue-600 hover:text-blue-800">
                                                    View this question in the FAQ section →
                                                </a>
                                            </div>
                                        @endif
                                    @else
                                        <div class="mt-4 text-sm text-gray-500">
                                            Awaiting response...
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>