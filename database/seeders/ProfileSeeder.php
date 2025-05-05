<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder {
    public function run(): void {
        DB::table('profiles')->insert([
            [
                'id'                      => 1,
                'user_id'                 => 1,
                'phone_number'            => '0123456789',
                'linkedin_profile_url'    => null,
                'revenue_generated_year'  => null,
                'revenue_generated'       => null,
                'industry_experience'     => null,
                'present_club_experience' => null,
                'lead_close_ratio'        => null,
                'working_role'            => null,
                'country'                 => null,
                'bio'                     => null,
                'status'                  => 'active',
                'created_at'              => '2025-05-05 12:25:22',
                'updated_at'              => '2025-05-05 12:25:22',
                'deleted_at'              => null,
            ],
            [
                'id'                      => 2,
                'user_id'                 => 2,
                'phone_number'            => '1234567890',
                'linkedin_profile_url'    => 'https://salesrank-react.vercel.app',
                'revenue_generated_year'  => 2025,
                'revenue_generated'       => 50.00,
                'industry_experience'     => 1.7,
                'present_club_experience' => 1.5,
                'lead_close_ratio'        => 80.20,
                'working_role'            => null,
                'country'                 => null,
                'bio'                     => null,
                'status'                  => 'active',
                'created_at'              => '2025-05-05 12:27:22',
                'updated_at'              => '2025-05-05 12:27:22',
                'deleted_at'              => null,
            ],
            [
                'id'                      => 3,
                'user_id'                 => 3,
                'phone_number'            => '123456789',
                'linkedin_profile_url'    => 'https://salesrank-react.vercel.app',
                'revenue_generated_year'  => 2025,
                'revenue_generated'       => 50.00,
                'industry_experience'     => 1.7,
                'present_club_experience' => 1.5,
                'lead_close_ratio'        => 80.20,
                'working_role'            => null,
                'country'                 => null,
                'bio'                     => null,
                'status'                  => 'active',
                'created_at'              => '2025-05-05 12:28:14',
                'updated_at'              => '2025-05-05 12:28:14',
                'deleted_at'              => null,
            ],
        ]);
    }
}
