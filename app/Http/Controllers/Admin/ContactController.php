<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\FaqItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('user')->latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function respond(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'response' => 'required|string'
        ]);

        $contact->update([
            'admin_response' => $validated['response'],
            'is_answered' => true
        ]);

        return back()->with('status', 'Response sent successfully.');
    }

    public function convertToFaq(Contact $contact, Request $request)
    {
        try {
            $validated = $request->validate([
                'question' => 'required|string|max:1000',
                'answer' => 'required|string|max:5000',
                'category' => 'required|string|in:Weapons,Bugs,Gameplay,Trading'
            ]);

            DB::beginTransaction();

            // Create new FAQ item
            $faqItem = FaqItem::create([
                'question' => $validated['question'],
                'answer' => $validated['answer'],
                'category' => $validated['category']
            ]);

            // Update the contact to mark it as converted
            $contact->update([
                'is_converted_to_faq' => true,
                'faq_id' => $faqItem->id
            ]);

            DB::commit();

            return redirect()
                ->route('admin.contacts.show', $contact)
                ->with('status', 'Successfully converted to FAQ!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('FAQ conversion failed: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to convert to FAQ. Please try again.']);
        }
    }

    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();
            
            return redirect()
                ->route('admin.contacts.index')
                ->with('status', 'Contact message deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete contact: ' . $e->getMessage());
            
            return back()->withErrors(['error' => 'Failed to delete contact message.']);
        }
    }
}
