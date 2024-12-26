<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
                'picture' => 'required|image|max:2048'
            ]);

            $picturePath = $request->file('picture')->store('news', 'public');

            $newsItem = NewsItem::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'picture_path' => $picturePath
            ]);

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'News item created successfully',
                    'newsItem' => $newsItem
                ]);
            }

            return redirect()->back()->with('success', 'News item created successfully');
        } catch (\Exception $e) {
            Log::error('News creation error: ' . $e->getMessage());
            
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => 'Failed to create news item',
                    'message' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Failed to create news item')
                ->withInput();
        }
    }
} 