<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder {
    public function run(): void {
        Feature::insert([
            [
                'id'          => 1,
                'title'       => 'Keeping Sales Teams Thriving with Expert Performance Solutions.',
                'image'       => 'seeder/salesteam.png',
                'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                'status'      => 'active',
                'created_at'  => '2025-05-17 06:30:29',
                'updated_at'  => '2025-05-17 06:30:29',
            ],
            [
                'id'          => 2,
                'title'       => 'Comprehensive Solutions Tailored to Your Sales Team’s Needs',
                'image'       => 'seeder/salesteam.png',
                'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                'status'      => 'active',
                'created_at'  => '2025-05-17 06:31:55',
                'updated_at'  => '2025-05-17 06:31:55',
            ],
        ]);
    }
}
