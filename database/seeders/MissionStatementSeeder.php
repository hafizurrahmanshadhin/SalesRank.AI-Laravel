<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MissionStatementSeeder extends Seeder {
    public function run(): void {
        DB::table('mission_statements')->insert([
            [
                'id'          => 1,
                'image'       => 'seeder/missionStatement.png',
                'description' => '<p>At SalesRank.AI, we are building the global standard for identifying elite sales talent—bringing transparency, trust, and better results for both companies and top consultants. Great salespeople drive success, but for too long, companies have relied on gut instinct, biased referrals, and guesswork when hiring closers. Resumes can be misleading, interviews are rehearsed, and referrals lack objectivity. The wrong hire costs valuable time, money, and momentum. That’s why we leverage AI-driven insights to revolutionize the way businesses identify, evaluate, and recruit top-performing sales professionals—ensuring data-backed decisions that lead to real growth.</p>',
                'created_at'  => '2025-05-15 11:19:29',
                'updated_at'  => '2025-05-15 11:21:44',
            ],
        ]);
    }
}
