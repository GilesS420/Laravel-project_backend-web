<?php

namespace App\Http\Controllers;

use App\Models\FaqItem;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
            'category' => 'required|exists:faq_categories,name'
        ]);

        FaqItem::create($validated);
        return redirect()->back()->with('success', 'FAQ item created successfully');
    }

    public function update(Request $request, FaqItem $faqItem)
    {
        $validated = $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
            'category' => 'required|exists:faq_categories,name'
        ]);

        $faqItem->update($validated);

        if ($request->wantsJson()) {
            return response()->json(['faqItem' => $faqItem]);
        }

        return redirect()->back()->with('success', 'FAQ item updated successfully');
    }

    public function destroy(FaqItem $faqItem)
    {
        try {
            $faqItem->delete();
            return response()->json(['message' => 'FAQ item deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete FAQ item'], 500);
        }
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:faq_categories,name'
        ]);

        $category = FaqCategory::create([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'category' => $category
        ]);
    }

    public function index()
    {
        $faqs = FaqItem::all();
        $categories = FaqCategory::all();
        
        return view('community.faq', compact('faqs', 'categories'));
    }
} 