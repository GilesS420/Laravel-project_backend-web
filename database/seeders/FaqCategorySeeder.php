<?php

namespace Database\Seeders;

use App\Models\FaqCategory;
use Illuminate\Database\Seeder;

class FaqCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Weapons',
            'Bugs',
            'Gameplay',
            'Trading'
        ];

        foreach ($categories as $category) {
            FaqCategory::firstOrCreate(['name' => $category]);
        }
    }
} 