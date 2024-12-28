<?php

namespace Database\Seeders;

use App\Models\Weapon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class WeaponSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Clear existing weapons and favorites
        DB::table('weapon_favorites')->truncate();
        DB::table('weapons')->truncate();

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();

        $weapons = [
            [
                'name' => 'AK-47',
                'type' => 'rifle',
                'price' => 2700,
                'difficulty' => 'medium',
                'description' => 'Powerful and popular assault rifle',
                'image' => 'Pictures/AK-47.jpg'
            ],
            [
                'name' => 'M4A4-S',
                'type' => 'rifle',
                'price' => 3100,
                'difficulty' => 'medium',
                'description' => 'Versatile CT-side assault rifle',
                'image' => 'Pictures/m4a4.png'
            ],
            [
                'name' => 'AWP',
                'type' => 'rifle',
                'price' => 4750,
                'difficulty' => 'hard',
                'description' => 'High-powered sniper rifle',
                'image' => 'Pictures/awp.png'
            ],

            // Pistols
            [
                'name' => 'USP-S',
                'type' => 'pistol',
                'price' => 200,
                'difficulty' => 'easy',
                'description' => 'CT starting pistol',
                'image' => 'Pictures/usps.png'
            ],
            [
                'name' => 'Glock-18',
                'type' => 'pistol',
                'price' => 200,
                'difficulty' => 'easy',
                'description' => 'T starting pistol',
                'image' => 'Pictures/glock.png'
            ],
            [
                'name' => 'Desert Eagle',
                'type' => 'pistol',
                'price' => 700,
                'difficulty' => 'hard',
                'description' => 'Powerful hand cannon',
                'image' => 'Pictures/deagle.png'
            ],

            // SMGs
            [
                'name' => 'MP9',
                'type' => 'smg',
                'price' => 1250,
                'difficulty' => 'easy',
                'description' => 'CT-side SMG',
                'image' => 'Pictures/mp9.png'
            ],
            [
                'name' => 'MAC-10',
                'type' => 'smg',
                'price' => 1050,
                'difficulty' => 'easy',
                'description' => 'T-side SMG',
                'image' => 'Pictures/mac10.png'
            ],
            [
                'name' => 'P90',
                'type' => 'smg',
                'price' => 2350,
                'difficulty' => 'easy',
                'description' => 'High capacity SMG',
                'image' => 'Pictures/p90.png'
            ],

            // Heavy
            [
                'name' => 'Nova',
                'type' => 'heavy',
                'price' => 1050,
                'difficulty' => 'medium',
                'description' => 'Pump-action shotgun',
                'image' => 'Pictures/nova.png'
            ],
            [
                'name' => 'XM1014',
                'type' => 'heavy',
                'price' => 2000,
                'difficulty' => 'medium',
                'description' => 'Auto shotgun',
                'image' => 'Pictures/xm1014.png'
            ],
            [
                'name' => 'M249',
                'type' => 'heavy',
                'price' => 5200,
                'difficulty' => 'medium',
                'description' => 'Light machine gun',
                'image' => 'Pictures/m249.png'
            ],
        ];

        foreach ($weapons as $weapon) {
            Weapon::create($weapon);
        }
    }
}