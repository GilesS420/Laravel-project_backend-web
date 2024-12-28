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
                        <select id="category" 
                                name="category" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="Weapons">Weapons</option>
                            <option value="Bugs">Bugs</option>
                            <option value="Gameplay">Gameplay</option>
                            <option value="Trading">Trading</option>
                        </select>
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
function closeFaqModal() {
    document.getElementById('faqModal').classList.add('hidden');
}

// Add this to show the modal when the Convert to FAQ button is clicked
function showFaqModal() {
    document.getElementById('faqModal').classList.remove('hidden');
}
</script> 