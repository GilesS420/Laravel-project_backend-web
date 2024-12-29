<div id="faqModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        
        <div class="relative bg-white rounded-lg max-w-lg w-full">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="faqModalTitle">Convert to FAQ</h3>
                <form id="faqForm" method="POST" action="{{ route('admin.contacts.convert-to-faq', $contact) }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Question</label>
                        <input type="text" 
                               id="question" 
                               name="question" 
                               value="{{ $contact->message }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Answer</label>
                        <textarea id="answer" 
                                name="answer" 
                                rows="4" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $contact->admin_response }}</textarea>
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
                            Convert
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Let's add a DOMContentLoaded event to ensure the JavaScript runs after the page loads
document.addEventListener('DOMContentLoaded', function() {
    // Debug log to check if script is running
    console.log('FAQ modal script loaded');

    const categorySelect = document.getElementById('category');
    if (categorySelect) {
        console.log('Category select found');
        categorySelect.addEventListener('change', function() {
            console.log('Category changed to:', this.value);
            const newCategoryInput = document.getElementById('newCategoryInput');
            if (this.value === 'new') {
                this.classList.add('hidden');
                newCategoryInput.classList.remove('hidden');
                document.getElementById('newCategory').focus();
            }
        });
    } else {
        console.error('Category select not found');
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

function addNewCategory() {
    const categorySelect = document.getElementById('category');
    const newCategoryInput = document.getElementById('newCategory');
    const newCategoryValue = newCategoryInput.value.trim();
    
    console.log('Adding new category:', newCategoryValue);
    
    if (newCategoryValue) {
        const newOption = new Option(newCategoryValue, newCategoryValue);
        categorySelect.insertBefore(newOption, categorySelect.lastElementChild);
        categorySelect.value = newCategoryValue;
        
        newCategoryInput.value = '';
        document.getElementById('newCategoryInput').classList.add('hidden');
        categorySelect.classList.remove('hidden');
    }
}

function showFaqModal() {
    console.log('Opening FAQ modal');
    document.getElementById('faqModal').classList.remove('hidden');
}

function closeFaqModal() {
    console.log('Closing FAQ modal');
    document.getElementById('faqModal').classList.add('hidden');
    document.getElementById('category').value = 'Weapons';
    document.getElementById('category').classList.remove('hidden');
    document.getElementById('newCategoryInput').classList.add('hidden');
}
</script> 