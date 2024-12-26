<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NewsItem;
use App\Models\FaqItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CommunityController extends Controller
{
    public function index()
    {
        try {
            $users = User::latest()->paginate(12);
            $newsItems = collect();  // Start with empty collections
            $faqItems = collect();

            // Only try to get these if the tables exist
            if (Schema::hasTable('news_items')) {
                $newsItems = NewsItem::latest()->get();
            }
            if (Schema::hasTable('faq_items')) {
                $faqItems = FaqItem::all();
            }

            return view('community.index', compact('users', 'newsItems', 'faqItems'));
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return view('community.index', [
                'users' => User::latest()->paginate(12),
                'newsItems' => collect(),
                'faqItems' => collect()
            ]);
        }
    }

    public function show(User $user)
    {
        return view('community.show', compact('user'));
    }
} 