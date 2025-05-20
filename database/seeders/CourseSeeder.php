<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder {
    public function run(): void {
        DB::table('courses')->insert([
            [
                'id'              => 1,
                'title'           => 'Web Design Fundamentals',
                'description'     => '<p>Learn the fundamentals of web design, including HTML, CSS, and responsive design principles. Develop the skills to create visually appealing and user-friendly websites.</p>',
                'conduct_by'      => 'By John Smith',
                'course_duration' => 4,
                'course_level'    => 'beginner',
                'image'           => 'seeder/aiimg7.png',
                'status'          => 'active',
                'created_at'      => '2025-05-20 05:10:18',
                'updated_at'      => '2025-05-20 05:10:18',
                'deleted_at'      => null,
            ],
            [
                'id'              => 2,
                'title'           => 'Advanced UI/UX Design',
                'description'     => '<p>Deep dive into UI/UX principles, wireframing, and prototyping with tools like Figma and Adobe XD.</p>',
                'conduct_by'      => 'By Jane Doe',
                'course_duration' => 6,
                'course_level'    => 'intermediate',
                'image'           => 'seeder/aiimg7.png',
                'status'          => 'active',
                'created_at'      => '2025-05-20 05:11:14',
                'updated_at'      => '2025-05-20 05:11:14',
                'deleted_at'      => null,
            ],
        ]);
    }
}
