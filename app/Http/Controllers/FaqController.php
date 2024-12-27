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
} 