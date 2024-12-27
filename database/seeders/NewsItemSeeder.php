<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsItem;
use Carbon\Carbon;

class NewsItemSeeder extends Seeder
{
    public function run()
    {
        $newsItems = [
            [
                'title' => 'Major Update: New Dust2 Overhaul',
                'content' => 'Valve has released a massive update to the iconic Dust2 map, featuring improved visibility, updated textures, and refined gameplay angles. The changes aim to enhance competitive play while maintaining the map\'s classic feel.',
                'created_at' => Carbon::now()->subDays(2),
                'picture_path' => 'Pictures/dust2.jpg',
            ],
            [
                'title' => 'CS2 Premier Mode Rankings Released',
                'content' => 'The new Premier Mode ranking system is now live! Players can now compete in a more structured competitive environment with visible skill ratings and improved matchmaking.',
                'created_at' => Carbon::now()->subDays(4),
                'picture_path' => 'Pictures/premier.jpg',
            ],
            [
                'title' => 'New Operation: Shadow Protocol',
                'content' => 'Get ready for Operation Shadow Protocol! Featuring new weapon collections, missions, and exclusive rewards. The operation introduces a new competitive map and unique player challenges.',
                'created_at' => Carbon::now()->subDays(6),
                'picture_path' => 'Pictures/operation.jpg',
            ],
            [
                'title' => 'Pro Scene: NAVI Wins Major Championship',
                'content' => 'Na\'Vi has secured their victory at the CS2 Major Championship, defeating FaZe Clan in an intense 5-map series. s1mple leads the team to another historic victory.',
                'created_at' => Carbon::now()->subDays(8),
                'picture_path' => 'Pictures/navi.jpg',
            ],
            [
                'title' => 'Weapon Balance Update',
                'content' => 'Latest patch introduces crucial weapon balancing changes. The M4A1-S receives slight adjustments, while the AK-47 spray pattern has been refined for better consistency.',
                'created_at' => Carbon::now()->subDays(10),
                'picture_path' => 'Pictures/weapons.jpg',
            ],
            [
                'title' => 'New Case: Revolution Collection',
                'content' => 'The Revolution Case has arrived with 17 new community-created weapon skins, including new finishes for the AK-47, M4A4, and AWP. Features the exclusive Revolution Knife collection.',
                'created_at' => Carbon::now()->subDays(12),
                'picture_path' => 'Pictures/case.jpg',
            ],
            [
                'title' => 'Sub-Tick Update Implementation',
                'content' => 'Valve introduces revolutionary sub-tick update system in CS2, promising more accurate hit registration and improved server performance across all official matchmaking.',
                'created_at' => Carbon::now()->subDays(14),
                'picture_path' => 'Pictures/subtick.jpg',
            ],
            [
                'title' => 'Community Workshop Winners Announced',
                'content' => 'The latest Community Workshop competition winners have been selected. Winning designs will be implemented in the upcoming weapon case, with creators receiving special recognition.',
                'created_at' => Carbon::now()->subDays(16),
                'picture_path' => 'Pictures/workshop.jpg',
            ],
            [
                'title' => 'ESL Pro League Season 18 Schedule',
                'content' => 'ESL announces the complete schedule for Pro League Season 18, featuring 24 top teams competing for a $850,000 prize pool. Tournament to begin next month.',
                'created_at' => Carbon::now()->subDays(18),
                'picture_path' => 'Pictures/esl.jpg',
            ],
            [
                'title' => 'Source 2 Engine Optimization Update',
                'content' => 'Latest CS2 patch brings significant performance improvements through Source 2 engine optimizations. Players report higher FPS and better stability across all map pools.',
                'created_at' => Carbon::now()->subDays(20),
                'picture_path' => 'Pictures/source2.jpg',
            ],
        ];

        foreach ($newsItems as $item) {
            NewsItem::create($item);
        }
    }
}
