<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'picture' => 'nullable|image|max:2048' // max 2MB
        ]);

        $newsItem = new NewsItem();
        $newsItem->title = $request->title;
        $newsItem->content = $request->content;

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            
            // Create a simpler filename that's still unique
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            
            // Ensure the Pictures directory exists
            if (!file_exists(public_path('Pictures'))) {
                mkdir(public_path('Pictures'), 0777, true);
            }
            
            // Move the file directly to public/Pictures
            $file->move(public_path('Pictures'), $filename);
            
            // Store just the relative path
            $newsItem->picture_path = 'Pictures/' . $filename;
        }

        $newsItem->save();

        if ($request->wantsJson()) {
            return response()->json([
                'newsItem' => $newsItem,
                'imageUrl' => asset($newsItem->picture_path) // Add the full URL for the image
            ]);
        }

        return redirect()->back()->with('success', 'News item created successfully.');
    }

    public function destroy(NewsItem $newsItem)
    {
        try {
            // Delete the image file if it exists
            if ($newsItem->picture_path && file_exists(public_path($newsItem->picture_path))) {
                unlink(public_path($newsItem->picture_path));
            }
            
            $newsItem->delete();
            
            return response()->json(['message' => 'News item deleted successfully']);
        } catch (\Exception $e) {
            Log::error('News deletion error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete news item: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, NewsItem $newsItem)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'picture' => 'nullable|image|max:2048'
        ]);

        $newsItem->title = $request->title;
        $newsItem->content = $request->content;

        if ($request->hasFile('picture')) {
            // Delete old picture if it exists
            if ($newsItem->picture_path && file_exists(public_path($newsItem->picture_path))) {
                unlink(public_path($newsItem->picture_path));
            }
            
            $file = $request->file('picture');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            
            // Move the file directly to public/Pictures
            $file->move(public_path('Pictures'), $filename);
            
            // Update the path
            $newsItem->picture_path = 'Pictures/' . $filename;
        }

        $newsItem->save();

        if ($request->wantsJson()) {
            return response()->json(['newsItem' => $newsItem]);
        }

        return redirect()->back()->with('success', 'News item updated successfully.');
    }
} 