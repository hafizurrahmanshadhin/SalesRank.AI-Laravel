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
                'role_id'           => 1,
                'first_name'        => 'admin',
                'last_name'         => 'admin',
                'handle'            => 'admin',
                'email'             => 'admin@admin.com',
                'email_verified_at' => '2025-04-22 00:10:27',
                'password'          => Hash::make('12345678'),
                'avatar'            => null,
                'google_id'         => null,
                'status'            => 1,
                'remember_token'    => null,
                'created_at'        => '2025-04-22 00:10:27',
                'updated_at'        => '2025-04-22 00:10:27',
                'deleted_at'        => null,
            ],
            [
                'id'                => 2,
                'role_id'           => 2,
                'first_name'        => 'sales',
                'last_name'         => 'professional',
                'handle'            => 'sales_professional',
                'email'             => 'sales@professional.com',
                'email_verified_at' => '2025-04-22 00:10:44',
                'password'          => Hash::make('12345678'),
                'avatar'            => null,
                'google_id'         => null,
                'status'            => 1,
                'remember_token'    => null,
                'created_at'        => '2025-04-22 00:10:44',
                'updated_at'        => '2025-04-22 00:10:44',
                'deleted_at'        => null,
            ],
            [
                'id'                => 3,
                'role_id'           => 3,
                'first_name'        => 'hiring',
                'last_name'         => 'company',
                'handle'            => 'hiring_company',
                'email'             => 'hiring@company.com',
                'email_verified_at' => '2025-04-22 00:10:53',
                'password'          => Hash::make('12345678'),
                'avatar'            => null,
                'google_id'         => null,
                'status'            => 1,
                'remember_token'    => null,
                'created_at'        => '2025-04-22 00:10:53',
                'updated_at'        => '2025-04-22 00:10:53',
                'deleted_at'        => null,
            ],
        ]);
    }
}
