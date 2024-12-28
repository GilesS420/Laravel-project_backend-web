@inject('auth', 'Illuminate\Support\Facades\Auth')
@inject('url', 'Illuminate\Support\Facades\URL')
@inject('storage', 'Illuminate\Support\Facades\Storage')

<x-app-layout data-is-admin="{{ $auth::check() && $auth::user()->is_admin ? 'true' : 'false' }}">
    @include('auth._login-modal')
    @include('auth._register-modal')

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
                            @if($auth::check() && $auth::user()->is_admin)
                                <button onclick="openNewsModal()" 
                                        class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">
                                    Add News Item
                                </button>
                            @endif
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @forelse($newsItems as $item)
                                <div class="bg-white rounded-lg overflow-hidden shadow-sm" data-news-id="{{ $item->id }}">
                                    @if($item->picture_path)
                                        <img src="{{ asset($item->picture_path) }}" 
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
                                        @if($auth::check() && $auth::user()->is_admin)
                                            <div class="mt-4 flex gap-2">
                                                <button 
                                                    onclick="editNewsItem('{{ $item->id }}')" 
                                                    class="text-orange-600 hover:text-orange-700">
                                                    Edit
                                                </button>
                                                <button 
                                                    onclick="deleteNewsItem('{{ $item->id }}')" 
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
                            <div>
                                <h2 class="text-2xl font-bold">Frequently Asked Questions</h2>
                                <div class="mt-4 flex gap-2">
                                    <button onclick="filterFaqs('all')" 
                                            class="faq-filter px-3 py-1 rounded-full text-sm font-medium bg-orange-500 text-white">
                                        All
                                    </button>
                                    <button onclick="filterFaqs('Weapons')" 
                                            class="faq-filter px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-700">
                                        Weapons
                                    </button>
                                    <button onclick="filterFaqs('Bugs')" 
                                            class="faq-filter px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-700">
                                        Bugs
                                    </button>
                                    <button onclick="filterFaqs('Gameplay')" 
                                            class="faq-filter px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-700">
                                        Gameplay
                                    </button>
                                    <button onclick="filterFaqs('Trading')" 
                                            class="faq-filter px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-700">
                                        Trading
                                    </button>
                                </div>
                            </div>
                            @if($auth::check() && $auth::user()->is_admin)
                                <button onclick="openFaqModal()" 
                                        class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">
                                    Add FAQ Item
                                </button>
                            @endif
                        </div>
                        
                        <div class="space-y-4">
                            @forelse($faqItems as $item)
                                <div class="bg-white rounded-lg p-6 shadow-sm faq-item" 
                                     data-category="{{ $item->category }}"
                                     data-faq-id="{{ $item->id }}">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $item->question }}</h3>
                                        <span class="text-sm text-orange-600 font-medium">{{ $item->category }}</span>
                                    </div>
                                    <p class="mt-2 text-gray-600">{{ $item->answer }}</p>
                                    @if($auth::check() && $auth::user()->is_admin)
                                        <div class="mt-4 flex gap-2">
                                            <button onclick="editFaqItem('{{ $item->id }}')" 
                                                    class="text-orange-600 hover:text-orange-700">
                                                Edit
                                            </button>
                                            <button onclick="deleteFaqItem('{{ $item->id }}')" 
                                                    class="text-red-600 hover:text-red-700">
                                                Delete
                                            </button>
                                        </div>
                                    @endif
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
                            @if($auth::check() && $auth::user()->is_admin)
                                <a href="{{ route('admin.users.create') }}" 
                                   class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors inline-block">
                                    Add User
                                </a>
                            @endif
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
                                        
                                        @if($auth::check() && $auth::user()->is_admin && $auth::user()->id !== $user->id)
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
    @if($auth::check() && $auth::user()->is_admin)
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
            const modal = document.getElementById('newsModal');
            if (modal) {
                modal.classList.add('hidden');
            }
        }

        function openFaqModal() {
            document.getElementById('faqModal').classList.remove('hidden');
        }

        function closeFaqModal() {
            document.getElementById('faqModal').classList.add('hidden');
            document.getElementById('faqForm').reset();
            document.getElementById('faqModalTitle').textContent = 'Add FAQ Item';
            
            // Reset form action and remove method spoofing
            const form = document.getElementById('faqForm');
            form.action = "{{ route('faq.store') }}";
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) {
                methodInput.remove();
            }
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
            
            const formData = new FormData(this);
            const method = formData.get('_method') || 'POST';
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(this.action, {
                method: method === 'PUT' ? 'POST' : 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.newsItem) {
                    // Create new news item element
                    const newsContainer = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.gap-6');
                    const newsElement = document.createElement('div');
                    newsElement.className = 'bg-white rounded-lg overflow-hidden shadow-sm';
                    newsElement.setAttribute('data-news-id', data.newsItem.id);
                    
                    // Add the HTML content including the image
                    newsElement.innerHTML = `
                        ${data.newsItem.picture_path ? `
                            <img src="${data.imageUrl}" 
                                 alt="${data.newsItem.title}"
                                 class="w-full h-48 object-cover">
                        ` : ''}
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-semibold text-gray-900">${data.newsItem.title}</h3>
                                <span class="text-sm text-gray-500">Just now</span>
                            </div>
                            <p class="text-gray-600">${data.newsItem.content}</p>
                            <div class="mt-4 flex gap-2">
                                <button onclick="editNewsItem('${data.newsItem.id}')" 
                                        class="text-orange-600 hover:text-orange-700">
                                    Edit
                                </button>
                                <button onclick="deleteNewsItem('${data.newsItem.id}')" 
                                        class="text-red-600 hover:text-red-700">
                                    Delete
                                </button>
                            </div>
                        </div>
                    `;
                    
                    // Add the new item to the beginning of the list
                    newsContainer.insertBefore(newsElement, newsContainer.firstChild);
                    
                    // Close the modal
                    closeNewsModal();
                    
                    // Reset the form
                    this.reset();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to save news item');
            });
        });

        function deleteNewsItem(id) {
            if (!confirm('Are you sure you want to delete this news item?')) {
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(`/news/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    // Find and remove the news item element
                    const newsItem = document.querySelector(`[data-news-id="${id}"]`);
                    if (newsItem) {
                        // Add a fade-out effect
                        newsItem.style.transition = 'opacity 0.3s ease';
                        newsItem.style.opacity = '0';
                        
                        // Remove the element after the fade animation
                        setTimeout(() => {
                            newsItem.remove();
                        }, 300);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to delete news item');
            });
        }

        function editNewsItem(id) {
            // Get the news item data
            const newsItem = document.querySelector(`[data-news-id="${id}"]`);
            const title = newsItem.querySelector('h3').textContent;
            const content = newsItem.querySelector('p').textContent;

            // Populate the modal with existing data
            document.getElementById('newsModal').classList.remove('hidden');
            document.getElementById('title').value = title;
            document.getElementById('content').value = content;
            
            // Update form action and method for edit
            const form = document.getElementById('newsForm');
            form.action = `/news/${id}`;
            
            // Add method spoofing for PUT request
            let methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';
        }

        function filterFaqs(category) {
            // Update filter buttons
            document.querySelectorAll('.faq-filter').forEach(button => {
                if (button.textContent.trim() === category || (category === 'all' && button.textContent.trim() === 'All')) {
                    button.classList.remove('bg-gray-200', 'text-gray-700');
                    button.classList.add('bg-orange-500', 'text-white');
                } else {
                    button.classList.remove('bg-orange-500', 'text-white');
                    button.classList.add('bg-gray-200', 'text-gray-700');
                }
            });

            // Filter FAQ items
            document.querySelectorAll('.faq-item').forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        }

        function deleteFaqItem(id) {
            if (!confirm('Are you sure you want to delete this FAQ item?')) {
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(`/faq/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    // Find and remove the FAQ item element
                    const faqItem = document.querySelector(`[data-faq-id="${id}"]`);
                    if (faqItem) {
                        // Add a fade-out effect
                        faqItem.style.transition = 'opacity 0.3s ease';
                        faqItem.style.opacity = '0';
                        
                        // Remove the element after the fade animation
                        setTimeout(() => {
                            faqItem.remove();
                        }, 300);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to delete FAQ item');
            });
        }

        function editFaqItem(id) {
            // Get the FAQ item data
            const faqItem = document.querySelector(`[data-faq-id="${id}"]`);
            if (!faqItem) {
                console.error('FAQ item not found');
                return;
            }

            const question = faqItem.querySelector('h3').textContent;
            const answer = faqItem.querySelector('p').textContent;
            const category = faqItem.querySelector('span').textContent;

            // Populate the modal with existing data
            document.getElementById('faqModal').classList.remove('hidden');
            document.getElementById('question').value = question;
            document.getElementById('answer').value = answer;
            document.getElementById('category').value = category;
            
            // Update form action and method for edit
            const form = document.getElementById('faqForm');
            form.action = `/faq/${id}`;
            
            // Add method spoofing for PUT request
            let methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';

            // Update modal title
            document.getElementById('faqModalTitle').textContent = 'Edit FAQ Item';
        }
    </script>
</x-app-layout> 