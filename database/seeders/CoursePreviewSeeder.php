<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursePreviewSeeder extends Seeder {
    public function run(): void {
        DB::table('course_previews')->insert([
            [
                'id'          => 1,
                'title'       => 'Our Courses',
                'description' => '<p>Explore our range of courses designed for beginners to advanced learners. Improve your skills and advance your career with hands-on projects and expert guidance.</p>',
                'created_at'  => '2025-05-20 05:08:18',
                'updated_at'  => '2025-05-20 05:08:18',
            ],
        ]);
    }
}
