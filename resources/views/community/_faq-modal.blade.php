<div id="faqModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        
        <div class="relative bg-white rounded-lg max-w-lg w-full">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="faqModalTitle">Add FAQ Item</h3>
                <form id="faqForm" method="POST" action="{{ route('faq.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Question</label>
                        <input type="text" 
                               id="question" 
                               name="question" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Answer</label>
                        <textarea id="answer" 
                                name="answer" 
                                rows="4" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <div class="flex gap-2">
                            <select id="category" 
                                    name="category" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @foreach($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                                <option value="new">+ Add New Category</option>
                            </select>
                            <div id="newCategoryInput" class="hidden mt-1 flex gap-2 w-full">
                                <input type="text" 
                                       id="newCategory" 
                                       placeholder="Enter new category"
                                       class="block w-full rounded-md border-gray-300 shadow-sm">
                                <button type="button" 
                                        onclick="addNewCategory()"
                                        class="px-3 py-2 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-700">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeFaqModal()" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category');
    if (categorySelect) {
        categorySelect.addEventListener('change', function() {
            const newCategoryInput = document.getElementById('newCategoryInput');
            if (this.value === 'new') {
                this.classList.add('hidden');
                newCategoryInput.classList.remove('hidden');
                document.getElementById('newCategory').focus();
            }
        });
    }

    const newCategoryInput = document.getElementById('newCategory');
    if (newCategoryInput) {
        newCategoryInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addNewCategory();
            }
        });
    }
});

async function addNewCategory() {
    const categorySelect = document.getElementById('category');
    const newCategoryInput = document.getElementById('newCategory');
    const newCategoryValue = newCategoryInput.value.trim();
    
    if (newCategoryValue) {
        try {
            const response = await fetch('{{ route("faq.categories.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: newCategoryValue
                })
            });

            const data = await response.json();

            if (data.success) {     
                const newOption = new Option(newCategoryValue, newCategoryValue);
                categorySelect.insertBefore(newOption, categorySelect.lastElementChild);
                categorySelect.value = newCategoryValue;
            
                newCategoryInput.value = '';
                document.getElementById('newCategoryInput').classList.add('hidden');
                categorySelect.classList.remove('hidden');
            } else {
                alert('Failed to add category. Please try again.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Failed to add category. Please try again.');
        }
    }
}

function closeFaqModal() {
    document.getElementById('faqModal').classList.add('hidden');
    document.getElementById('category').value = 'Weapons';
    document.getElementById('category').classList.remove('hidden');
    document.getElementById('newCategoryInput').classList.add('hidden');
}
</script> 