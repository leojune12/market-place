<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::find(1)) {

            $admin = User::firstOrCreate([
                "first_name" => "Admin",
                "last_name" => "Admin",
                "email" => "admin@test.com",
                "email_verified_at" => now(),
                "password" => Hash::make("pw@12345"),
                "remember_token" => Str::random(10),
            ]);

            $admin->assignRole('admin');
        }
    }
}
