@php use Illuminate\Support\Facades\Auth; @endphp

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <!-- Centered Tabs with Orange Theme -->
                <div class="border-b border-gray-200 bg-white">
                    <nav class="flex justify-center" aria-label="Tabs">
                        <div class="flex space-x-12 px-4">
                            <button onclick="switchTab('news')" 
                                    class="tab-button whitespace-nowrap py-6 px-6 text-lg font-medium transition-colors duration-200 border-b-2 border-transparent hover:border-orange-500"
                                    id="news-tab">
                                News Items
                            </button>
                            <button onclick="switchTab('faq')"
                                    class="tab-button whitespace-nowrap py-6 px-6 text-lg font-medium transition-colors duration-200 border-b-2 border-transparent hover:border-orange-500"
                                    id="faq-tab">
                                FAQ
                            </button>
                            <button onclick="switchTab('users')"
                                    class="tab-button whitespace-nowrap py-6 px-6 text-lg font-medium transition-colors duration-200 border-b-2 border-transparent hover:border-orange-500"
                                    id="users-tab">
                                Users
                            </button>
                        </div>
                    </nav>
                </div>

                <!-- Content sections with updated background -->
                <div class="bg-gray-100">
                    <!-- News Content -->
                    <div id="news-content" class="tab-content p-8">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold">Latest News</h2>
                            @auth
                                @if(Auth::user()->is_admin)
                                    <button onclick="openNewsModal()" 
                                            class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">
                                        Add News Item
                                    </button>
                                @endif
                            @endauth
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @forelse($newsItems as $item)
                                <div class="bg-white rounded-lg overflow-hidden shadow-sm">
                                    @if($item->picture_path)
                                        <img src="{{ Storage::url($item->picture_path) }}" 
                                             alt="{{ $item->title }}"
                                             class="w-full h-48 object-cover">
                                    @endif
                                    <div class="p-6">
                                        <div class="flex justify-between items-start mb-2">
                                            <h3 class="text-xl font-semibold text-gray-900">{{ $item->title }}</h3>
                                            <span class="text-sm text-gray-500">
                                                {{ $item->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="text-gray-600">{{ $item->content }}</p>
                                        @if(Auth::check() && Auth::user()->is_admin)
                                            <div class="mt-4 flex gap-2">
                                                <button onclick="editNewsItem({{ $item->id }})" 
                                                        class="text-orange-600 hover:text-orange-700">
                                                    Edit
                                                </button>
                                                <button onclick="deleteNewsItem({{ $item->id }})" 
                                                        class="text-red-600 hover:text-red-700">
                                                    Delete
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-600">No news items available at the moment.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- FAQ Content -->
                    <div id="faq-content" class="tab-content p-8 hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold">Frequently Asked Questions</h2>
                            @auth
                                @if(Auth::user()->is_admin)
                                    <button onclick="openFaqModal()" 
                                            class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">
                                        Add FAQ Item
                                    </button>
                                @endif
                            @endauth
                        </div>
                        
                        <div class="space-y-4">
                            @forelse($faqItems as $item)
                                <div class="bg-white rounded-lg p-6 shadow-sm">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $item->question }}</h3>
                                        @if(Auth::check() && Auth::user()->is_admin)
                                            <div class="flex gap-2">
                                                <button onclick="editFaqItem({{ $item->id }})" 
                                                        class="text-orange-600 hover:text-orange-700">
                                                    Edit
                                                </button>
                                                <button onclick="deleteFaqItem({{ $item->id }})" 
                                                        class="text-red-600 hover:text-red-700">
                                                    Delete
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="mt-2 text-gray-600">{{ $item->answer }}</p>
                                </div>
                            @empty
                                <p class="text-gray-600">No FAQ items available at the moment.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Users Content -->
                    <div id="users-content" class="tab-content p-8 hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold">Community Members</h2>
                            @auth
                                @if(Auth::user()->is_admin)
                                    <button onclick="window.location.href='{{ route('admin.users.create') }}'" 
                                            class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">
                                        Add User
                                    </button>
                                @endif
                            @endauth
                        </div>
                        
                        <div class="divide-y divide-gray-200">
                            @foreach($users as $user)
                                <div class="py-4">
                                    <div class="flex items-center justify-between hover:bg-white p-4 rounded-lg transition-colors duration-200">
                                        <a href="{{ route('community.show', $user) }}" 
                                           class="flex items-center space-x-4">
                                            @if($user->avatar)
                                                <img src="{{ Storage::url($user->avatar) }}" 
                                                     alt="{{ $user->name }}'s Profile Picture"
                                                     class="h-12 w-12 rounded-full object-cover">
                                            @else
                                                <div class="h-12 w-12 rounded-full bg-orange-100 flex items-center justify-center">
                                                    <span class="text-lg font-medium text-orange-600">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                            @endif
                                            
                                            <div>
                                                <h3 class="text-lg font-medium text-gray-900">{{ $user->name }}</h3>
                                                @if($user->is_admin)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                        Admin
                                                    </span>
                                                @endif
                                            </div>
                                        </a>
                                        
                                        @if(Auth::check() && Auth::user()->is_admin && Auth::user()->id !== $user->id)
                                            <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST" class="ml-4">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="px-3 py-1 text-sm rounded-md {{ $user->is_admin ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                                                    {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals for adding/editing items -->
    @if(Auth::check() && Auth::user()->is_admin)
        @include('community._news-modal')
        @include('community._faq-modal')
    @endif

    <script>
        function switchTab(tabName) {
            // Hide all content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Show selected content
            document.getElementById(`${tabName}-content`).classList.remove('hidden');
            
            // Update tab styles
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('text-orange-600', 'border-orange-500');
                button.classList.add('text-gray-500', 'border-transparent');
            });
            
            // Highlight active tab
            const activeTab = document.getElementById(`${tabName}-tab`);
            activeTab.classList.remove('text-gray-500', 'border-transparent');
            activeTab.classList.add('text-orange-600', 'border-orange-500');

            // Store the active tab in localStorage
            localStorage.setItem('activeTab', tabName);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const storedTab = localStorage.getItem('activeTab') || 'news';
            switchTab(storedTab);
        });

        // Modal functions
        function openNewsModal() {
            document.getElementById('newsModal').classList.remove('hidden');
        }

        function closeNewsModal() {
            document.getElementById('newsModal').classList.add('hidden');
        }

        function openFaqModal() {
            document.getElementById('faqModal').classList.remove('hidden');
        }

        function closeFaqModal() {
            document.getElementById('faqModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const newsModal = document.getElementById('newsModal');
            const faqModal = document.getElementById('faqModal');
            if (event.target === newsModal) {
                closeNewsModal();
            }
            if (event.target === faqModal) {
                closeFaqModal();
            }
        }

        document.getElementById('newsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                credentials: 'same-origin',
            })
            .then(response => response.json())
            .then(data => {
                closeNewsModal();
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</x-app-layout> 