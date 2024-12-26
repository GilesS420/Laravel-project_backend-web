<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

