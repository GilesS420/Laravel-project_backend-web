<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NewsItem;
use App\Models\FaqItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        $newsItems = NewsItem::latest()->get(); // Order by latest first
        $faqItems = FaqItem::all();
        $users = User::paginate(10);

        return view('community.index', compact('newsItems', 'faqItems', 'users'));
    }

    public function show(User $user)
    {
        return view('community.show', compact('user'));
    }
} 