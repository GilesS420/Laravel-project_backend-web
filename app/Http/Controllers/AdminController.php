<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'birthday' => ['required', 'date'],
            'about' => ['required', 'string', 'min:10'],
            'is_admin' => ['boolean'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'birthday' => $request->birthday,
            'about' => $request->about,
            'is_admin' => $request->has('is_admin'),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function toggleAdmin(User $user)
    {
        // Prevent self-demotion
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot modify your own admin status.');
        }

        $user->update([
            'is_admin' => !$user->is_admin
        ]);

        $action = $user->is_admin ? 'promoted to admin' : 'demoted from admin';
        return back()->with('success', "User has been {$action}.");
    }
}

