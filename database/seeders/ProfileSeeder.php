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
                'role'                    => null,
                'country'                 => null,
                'bio'                     => null,
                'status'                  => 1,
                'created_at'              => '2025-04-22 00:10:27',
                'updated_at'              => '2025-04-22 00:10:27',
                'deleted_at'              => null,
            ],
            [
                'id'                      => 2,
                'user_id'                 => 2,
                'phone_number'            => '9876543210',
                'linkedin_profile_url'    => 'https://salesrank-react.vercel.app/dashboard/setting',
                'revenue_generated_year'  => 2025,
                'revenue_generated'       => 50.00,
                'industry_experience'     => 1.7,
                'present_club_experience' => 1.5,
                'lead_close_ratio'        => 80.20,
                'role'                    => null,
                'country'                 => null,
                'bio'                     => null,
                'status'                  => 1,
                'created_at'              => '2025-04-22 00:10:44',
                'updated_at'              => '2025-04-22 00:10:44',
                'deleted_at'              => null,
            ],
            [
                'id'                      => 3,
                'user_id'                 => 3,
                'phone_number'            => '159357258456',
                'linkedin_profile_url'    => 'https://salesrank-react.vercel.app/dashboard/setting',
                'revenue_generated_year'  => 2025,
                'revenue_generated'       => 50.00,
                'industry_experience'     => 1.7,
                'present_club_experience' => 1.5,
                'lead_close_ratio'        => 80.20,
                'role'                    => null,
                'country'                 => null,
                'bio'                     => null,
                'status'                  => 1,
                'created_at'              => '2025-04-22 00:10:53',
                'updated_at'              => '2025-04-22 00:10:53',
                'deleted_at'              => null,
            ],
        ]);
    }
}
