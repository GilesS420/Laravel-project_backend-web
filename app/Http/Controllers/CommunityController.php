<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NewsItem;
use App\Models\FaqItem;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        $newsItems = NewsItem::latest()->get();
        $faqItems = FaqItem::all();
        $users = User::paginate(10);
        $categories = FaqCategory::all();

        return view('community.index', compact('newsItems', 'faqItems', 'users', 'categories'));
    }

    public function show(User $user)
    {
        // Load the user's favorite weapons with their types
        $favoriteWeapons = $user->favoriteWeapons()->get()->groupBy('type');
        return view('community.show', compact('user', 'favoriteWeapons'));
    }
} 