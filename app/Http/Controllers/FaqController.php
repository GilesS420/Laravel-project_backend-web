<?php

namespace App\Http\Controllers;

use App\Models\FaqItem;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
            'category' => 'required|in:Weapons,Bugs,Gameplay,Trading'
        ]);

        FaqItem::create($validated);
        return redirect()->back()->with('success', 'FAQ item created successfully');
    }

    public function update(Request $request, FaqItem $faqItem)
    {
        $validated = $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
            'category' => 'required|in:Weapons,Bugs,Gameplay,Trading'
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
} 