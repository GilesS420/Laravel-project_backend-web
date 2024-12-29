<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\NewsItemSeeder;
use Database\Seeders\FaqItemSeeder;
use Database\Seeders\WeaponSeeder;
use Database\Seeders\FaqCategorySeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => Hash::make('Password!321'),
            'is_admin' => true,
        ]);

        $this->call([
            NewsItemSeeder::class,
            FaqItemSeeder::class,
            WeaponSeeder::class,
            FaqCategorySeeder::class,
        ]);
    }
}
