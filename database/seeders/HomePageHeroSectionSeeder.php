<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomePageHeroSectionSeeder extends Seeder {
    public function run(): void {
        DB::table('home_page_hero_sections')->insert([
            [
                'id'          => 1,
                'title'       => "The World's First Global Ranking Platform for Elite Sales Consultants",
                'description' => "<p>At SalesRank.AI, we've taken the guesswork out of hiring sales consultants. Our platform ranks the world's top closers across multiple industries - giving you data-backed insights into who actually delivers results. Whether you're scaling your sales team, launching a new product, or need a closer to land that next big deal, we make it easy to find and hire top-ranked talent you can trust.</p>",
                'image'       => 'seeder/hero.png',
                'created_at'  => '2025-05-12 04:09:57',
                'updated_at'  => '2025-05-12 04:09:57',
            ],
        ]);
    }
}
