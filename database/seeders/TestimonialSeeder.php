<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder {
    public function run(): void {
        DB::table('testimonials')->insert([
            [
                'id'          => 1,
                'name'        => 'John Doe',
                'title'       => 'CEO, Company',
                'image'       => null,
                'description' => '<p>They thoroughly analyze our industry and target audience, allowing them to develop customized campaigns that effectively reach and engage our customers.</p>',
                'status'      => 'active',
                'created_at'  => '2025-05-14 10:06:07',
                'updated_at'  => '2025-05-14 10:06:07',
                'deleted_at'  => null,
            ],
            [
                'id'          => 2,
                'name'        => 'Jane Smith',
                'title'       => 'Marketing Director',
                'image'       => null,
                'description' => '<p>Their creative ideas and cutting-edge techniques have helped us stay ahead of the competition.</p>',
                'status'      => 'active',
                'created_at'  => '2025-05-14 10:06:54',
                'updated_at'  => '2025-05-14 10:06:54',
                'deleted_at'  => null,
            ],
            [
                'id'          => 3,
                'name'        => 'Robert Johnson',
                'title'       => 'CTO, Tech Solutions',
                'image'       => null,
                'description' => '<p>Exceptional service with a strong focus on customer satisfaction!</p>',
                'status'      => 'active',
                'created_at'  => '2025-05-14 10:07:28',
                'updated_at'  => '2025-05-14 10:07:28',
                'deleted_at'  => null,
            ],
        ]);
    }
}
