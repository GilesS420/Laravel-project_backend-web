<div id="newsModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        
        <div class="relative bg-white rounded-lg max-w-lg w-full">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="newsModalTitle">Add News Item</h3>
                <form id="newsForm" method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data" 
                      onsubmit="setTimeout(function(){ window.location.reload(); }, 100)">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea name="content" id="content" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="picture" class="block text-sm font-medium text-gray-700">Picture</label>
                        <input type="file" name="picture" id="picture" accept="image/*" class="mt-1 block w-full">
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeNewsModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openNewsModal() {
    document.getElementById('newsForm').reset();
    document.getElementById('newsModalTitle').textContent = 'Add News Item';
    document.getElementById('newsForm').action = "{{ route('news.store') }}";
    const methodInput = document.getElementById('newsForm').querySelector('input[name="_method"]');
    if (methodInput) methodInput.remove();
    document.getElementById('newsModal').classList.remove('hidden');
}

function editNewsItem(id) {
    const newsItem = document.querySelector(`[data-news-id="${id}"]`);
    if (!newsItem) return;

    const title = newsItem.querySelector('h3').textContent.trim();
    const content = newsItem.querySelector('p').textContent.trim();

    document.getElementById('newsModalTitle').textContent = 'Edit News Item';
    document.getElementById('title').value = title;
    document.getElementById('content').value = content;
    
    const form = document.getElementById('newsForm');
    form.action = `{{ url('/news') }}/${id}`;
    
    const existingMethodInput = form.querySelector('input[name="_method"]');
    if (existingMethodInput) existingMethodInput.remove();
    
    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'PUT';
    form.appendChild(methodInput);
    
    document.getElementById('newsModal').classList.remove('hidden');
}

function closeNewsModal() {
    document.getElementById('newsModal').classList.add('hidden');
    document.getElementById('newsForm').reset();
    const methodInput = document.getElementById('newsForm').querySelector('input[name="_method"]');
    if (methodInput) methodInput.remove();
}
</script> 