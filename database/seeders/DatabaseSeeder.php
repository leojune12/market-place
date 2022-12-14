<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesDatabaseSeeder::class,
            AdminUserDatabaseSeeder::class,
            CategoriesDatabaseSeeder::class,
            SubcategoryDatabaseSeeder::class,
            AddressDatabaseSeeder::class,
            UserDatabaseSeeder::class,
        ]);
    }
}
