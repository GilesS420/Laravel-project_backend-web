<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\NewContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $contact = Contact::create([
            'user_id' => auth()->id(),
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'is_answered' => false
        ]);

        return redirect()
            ->route('contact.index')
            ->with('status', 'Your message has been sent successfully!');
    }

    public function index()
    {
        $user = auth()->user();
        $contacts = Contact::where('user_id', $user->id)
                          ->orderBy('created_at', 'desc')
                          ->get();
        
        return view('contact.index', compact('contacts'));
    }
}
