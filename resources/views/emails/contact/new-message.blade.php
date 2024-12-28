<x-mail::message>
# New Contact Message

**Subject:** {{ $contact->subject }}

**Message:**
{{ $contact->message }}

**From:** {{ $contact->user ? $contact->user->name : 'Anonymous' }}

<x-mail::button :url="route('admin.contacts.show', $contact)">
View Message
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> 