<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqItem;

class FaqItemSeeder extends Seeder
{
    public function run()
    {
        $faqs = [
            // Weapons Category
            [
                'question' => 'What is the most accurate rifle in CS2?',
                'answer' => 'The SG 553 (CT) and AUG (T) are considered the most accurate rifles when scoped, followed by the M4A4 and AK-47.',
                'category' => 'Weapons'
            ],
            [
                'question' => 'How do I control recoil patterns?',
                'answer' => 'Practice spray patterns in training maps, learn the first 8-10 bullets of each weapon, and pull down while slightly adjusting left or right based on the weapon.',
                'category' => 'Weapons'
            ],
            [
                'question' => 'What\'s the difference between M4A4 and M4A1-S?',
                'answer' => 'The M4A1-S is silenced, has less recoil, and fewer bullets, while the M4A4 has more bullets and higher fire rate but more recoil.',
                'category' => 'Weapons'
            ],
            [
                'question' => 'Which pistol has the highest armor penetration?',
                'answer' => 'The Desert Eagle has the highest armor penetration among pistols, making it effective against armored opponents.',
                'category' => 'Weapons'
            ],
            [
                'question' => 'What\'s the most cost-effective eco weapon?',
                'answer' => 'The Desert Eagle offers the best potential for eco rounds due to its one-shot headshot capability, while the Five-SeveN and Tec-9 are also popular choices.',
                'category' => 'Weapons'
            ],
            
            // Bugs Category
            [
                'question' => 'What should I do if my game crashes?',
                'answer' => 'Verify game files through Steam, update graphics drivers, and check for system compatibility. If issues persist, contact CS2 support.',
                'category' => 'Bugs'
            ],
            [
                'question' => 'How do I report a bug?',
                'answer' => 'Use the in-game bug reporter or submit a detailed report on the official CS2 community hub with screenshots/videos.',
                'category' => 'Bugs'
            ],
            [
                'question' => 'Why am I experiencing FPS drops?',
                'answer' => 'Check your video settings, update drivers, verify game files, and ensure your PC meets the minimum requirements.',
                'category' => 'Bugs'
            ],
            [
                'question' => 'What causes rubber banding in-game?',
                'answer' => 'Usually caused by network issues, high ping, or server problems. Check your internet connection and verify game files.',
                'category' => 'Bugs'
            ],
            [
                'question' => 'How to fix sound issues?',
                'answer' => 'Verify audio settings, check audio drivers, and ensure the correct output device is selected. Restart the game if issues persist.',
                'category' => 'Bugs'
            ],

            // Gameplay Category
            [
                'question' => 'How does the ranking system work?',
                'answer' => 'CS2 uses a modified Glicko-2 rating system based on round wins, MVPs, and personal performance against similarly ranked players.',
                'category' => 'Gameplay'
            ],
            [
                'question' => 'What are the best practice routines?',
                'answer' => 'Regular aim training, deathmatch sessions, spray control practice, and learning utility lineups on workshop maps.',
                'category' => 'Gameplay'
            ],
            [
                'question' => 'How do I improve my game sense?',
                'answer' => 'Watch pro matches, review your demos, learn common positions, and understand timing and rotations on maps.',
                'category' => 'Gameplay'
            ],
            [
                'question' => 'What is the best way to earn XP?',
                'answer' => 'Play competitive matches, complete missions, and participate in events. MVP stars and round wins provide the most XP.',
                'category' => 'Gameplay'
            ],
            [
                'question' => 'How does the economy system work?',
                'answer' => 'Teams earn money based on round wins/losses, kills, and objectives. Managing economy and coordinating team buys is crucial.',
                'category' => 'Gameplay'
            ],

            // Trading Category
            [
                'question' => 'How do I trade items safely?',
                'answer' => 'Only use official Steam trading, enable 2FA, verify trade offers carefully, and be aware of common scam methods.',
                'category' => 'Trading'
            ],
            [
                'question' => 'What affects skin prices?',
                'answer' => 'Rarity, wear condition, patterns, stickers, and market demand all influence skin prices.',
                'category' => 'Trading'
            ],
            [
                'question' => 'How long is the trade hold period?',
                'answer' => 'Trade holds vary based on Steam Guard settings, typically 15 days without mobile authenticator or 7 days for new devices.',
                'category' => 'Trading'
            ],
            [
                'question' => 'What are trade-up contracts?',
                'answer' => 'Trade-up contracts allow exchanging 10 items of the same quality for one item of higher quality.',
                'category' => 'Trading'
            ],
            [
                'question' => 'How do I check item authenticity?',
                'answer' => 'Use Steam inventory history, check market listings, and verify trade offers through official Steam channels.',
                'category' => 'Trading'
            ],
        ];

        foreach ($faqs as $faq) {
            FaqItem::create($faq);
        }
    }
} 