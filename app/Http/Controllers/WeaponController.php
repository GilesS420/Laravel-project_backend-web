<?php

namespace App\Http\Controllers;

use App\Models\Weapon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeaponController extends Controller
{
    public function index()
    {
        $weapons = Weapon::all()->groupBy('type');        
        return view('weapons.index', compact('weapons'));
    }

    public function toggleFavorite(Weapon $weapon)
    {
        $user = Auth::user();
        
        if ($weapon->isFavoritedBy($user)) {
            $weapon->favoritedBy()->detach($user);
            $message = 'Weapon removed from favorites';
        } else {
            $weapon->favoritedBy()->attach($user);
            $message = 'Weapon added to favorites';
        }

        return back()->with('status', $message);
    }
} 