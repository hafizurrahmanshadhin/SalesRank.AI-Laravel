<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        DB::table('users')->insert([
            [
                'id'                => 1,
                'first_name'        => 'admin',
                'last_name'         => 'admin',
                'user_name'         => 'admin',
                'email'             => 'admin@admin.com',
                'email_verified_at' => '2025-05-05 12:25:21',
                'password'          => Hash::make('12345678'),
                'avatar'            => null,
                'cover_photo'       => null,
                'google_id'         => null,
                'role'              => 'admin',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2025-05-05 12:25:22',
                'updated_at'        => '2025-05-05 12:25:22',
                'deleted_at'        => null,
            ],
            [
                'id'                => 2,
                'first_name'        => 'sales',
                'last_name'         => 'professional',
                'user_name'         => 'sales_professional',
                'email'             => 'sales@professional.com',
                'email_verified_at' => '2025-05-05 12:27:21',
                'password'          => Hash::make('12345678'),
                'avatar'            => null,
                'cover_photo'       => null,
                'google_id'         => null,
                'role'              => 'sales_professional',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2025-05-05 12:27:22',
                'updated_at'        => '2025-05-05 12:27:22',
                'deleted_at'        => null,
            ],
            [
                'id'                => 3,
                'first_name'        => 'hiring',
                'last_name'         => 'company',
                'user_name'         => 'hiring_company',
                'email'             => 'hiring@company.com',
                'email_verified_at' => '2025-05-05 12:28:14',
                'password'          => Hash::make('12345678'),
                'avatar'            => null,
                'cover_photo'       => null,
                'google_id'         => null,
                'role'              => 'hiring_company',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2025-05-05 12:29:14',
                'updated_at'        => '2025-05-05 12:29:14',
                'deleted_at'        => null,
            ],
        ]);
    }
}
