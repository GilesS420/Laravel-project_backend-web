<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'price',
        'difficulty',
        'image',
        'description'
    ];

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'weapon_favorites')
                    ->withTimestamps();
    }

    public function isFavoritedBy(User $user)
    {
        return $this->favoritedBy()->where('user_id', $user->id)->exists();
    }
} 