<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsletterSeeder extends Seeder {
    public function run(): void {
        DB::table('newsletters')->insert([
            [
                'id'         => 1,
                'name'       => 'Daniel Alves',
                'email'      => 'daniel3627@example.com',
                'text'       => 'Seventh piece of text here, which is deliberately verbose in order to meet the mandatory length requirement, going well beyond one hundred characters.',
                'status'     => 'active',
                'created_at' => '2025-05-15 09:28:18',
                'updated_at' => '2025-05-15 09:28:18',
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'name'       => 'John Doe',
                'email'      => 'john7093@hotmail.com',
                'text'       => 'Just testing the newsletter submission with a much longer text that definitely goes beyond one hundred characters so it can pass any length validation rules.',
                'status'     => 'active',
                'created_at' => '2025-05-15 09:28:49',
                'updated_at' => '2025-05-15 09:28:49',
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'name'       => 'John Smith',
                'email'      => 'john2069@hotmail.com',
                'text'       => 'This random text message has been extended to surpass the limit of one hundred characters, ensuring it meets the requirement for newsletter submission forms.',
                'status'     => 'active',
                'created_at' => '2025-05-15 09:28:50',
                'updated_at' => '2025-05-15 09:59:42',
                'deleted_at' => null,
            ],
            [
                'id'         => 4,
                'name'       => 'Sarah Connor',
                'email'      => 'sarah7622@example.com',
                'text'       => 'Fifth randomly chosen text to confirm that we exceed the set character limit for newsletter content, ensuring proper validation and illustrating realistic sample data.',
                'status'     => 'active',
                'created_at' => '2025-05-15 09:28:51',
                'updated_at' => '2025-05-15 09:58:58',
                'deleted_at' => null,
            ],
            [
                'id'         => 5,
                'name'       => 'Jane Austin',
                'email'      => 'jane1533@hotmail.com',
                'text'       => 'Hello! I\'d like to subscribe, but also ensuring this particular text block contains more than one hundred characters, fulfilling the necessary constraints.',
                'status'     => 'active',
                'created_at' => '2025-05-15 09:59:48',
                'updated_at' => '2025-05-15 09:59:48',
                'deleted_at' => null,
            ],
            [
                'id'         => 6,
                'name'       => 'Daniel Craig',
                'email'      => 'daniel5638@outlook.com',
                'text'       => 'Fourth extended random text. This example elaborates more thoroughly, surpassing one hundred characters, and demonstrating correct data length requirements.',
                'status'     => 'active',
                'created_at' => '2025-05-15 09:59:49',
                'updated_at' => '2025-05-15 09:59:49',
                'deleted_at' => null,
            ],
        ]);
    }
}
