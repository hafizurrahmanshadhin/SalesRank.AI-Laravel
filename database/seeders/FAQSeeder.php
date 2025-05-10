<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FAQSeeder extends Seeder {
    public function run(): void {
        DB::table('f_a_q_s')->insert([
            [
                'id'         => 1,
                'question'   => 'Why is digital marketing important for my business?',
                'answer'     => 'SalesRank.AI is an AI-powered platform that evaluates and ranks sales professionals across multiple industries. With features like AI-powered rankings, industry benchmarking, and skill verification, we help businesses identify top-performing sales professionals and enhance their sales strategies.',
                'type'       => 'SalesRank',
                'status'     => 'active',
                'created_at' => '2025-05-10 10:03:52',
                'updated_at' => '2025-05-10 10:03:52',
            ],
            [
                'id'         => 2,
                'question'   => 'How does SalesRank.AI help improve my sales team’s performance?',
                'answer'     => 'SalesRank.AI offers real-time data and analytics to identify your team\'s strengths and areas for improvement. With these insights, you can make data-driven decisions to improve performance and sales outcomes.',
                'type'       => 'SalesRank',
                'status'     => 'active',
                'created_at' => '2025-05-10 10:03:52',
                'updated_at' => '2025-05-10 10:03:52',
            ],
            [
                'id'         => 3,
                'question'   => 'How can I use SalesRank.AI to track and benchmark my team’s performance?',
                'answer'     => 'SalesRank.AI provides clear, industry-specific benchmarks and performance tracking tools. With this, you can compare your team’s performance against top performers and identify areas to improve.',
                'type'       => 'SalesRank',
                'status'     => 'active',
                'created_at' => '2025-05-10 10:03:52',
                'updated_at' => '2025-05-10 10:03:52',
            ],
            [
                'id'         => 4,
                'question'   => 'Can I integrate SalesRank.AI with my existing CRM or sales tools?',
                'answer'     => 'Yes, SalesRank.AI integrates with several CRM and sales tools, ensuring seamless synchronization with your existing systems to track and optimize your sales team’s performance.',
                'type'       => 'SalesRank',
                'status'     => 'active',
                'created_at' => '2025-05-10 10:03:52',
                'updated_at' => '2025-05-10 10:03:52',
            ],
            [
                'id'         => 5,
                'question'   => 'Why should I choose Humestic?',
                'answer'     => 'SalesRank.AI is an AI-powered platform that evaluates and ranks sales professionals across multiple industries. With features like AI-powered rankings, industry benchmarking, and skill verification, we help businesses identify top-performing sales professionals and enhance their sales strategies.',
                'type'       => 'Collaboration',
                'status'     => 'active',
                'created_at' => '2025-05-10 10:06:23',
                'updated_at' => '2025-05-10 10:06:23',
            ],
            [
                'id'         => 6,
                'question'   => 'I like your works, how do we start a project?',
                'answer'     => 'SalesRank.AI is an AI-powered platform that evaluates and ranks sales professionals across multiple industries. With features like AI-powered rankings, industry benchmarking, and skill verification, we help businesses identify top-performing sales professionals and enhance their sales strategies.',
                'type'       => 'Collaboration',
                'status'     => 'active',
                'created_at' => '2025-05-10 10:06:23',
                'updated_at' => '2025-05-10 10:06:23',
            ],
            [
                'id'         => 7,
                'question'   => 'What info is required to get a quotation?',
                'answer'     => 'SalesRank.AI is an AI-powered platform that evaluates and ranks sales professionals across multiple industries. With features like AI-powered rankings, industry benchmarking, and skill verification, we help businesses identify top-performing sales professionals and enhance their sales strategies.',
                'type'       => 'Collaboration',
                'status'     => 'active',
                'created_at' => '2025-05-10 10:06:23',
                'updated_at' => '2025-05-10 10:06:23',
            ],
        ]);
    }
}
