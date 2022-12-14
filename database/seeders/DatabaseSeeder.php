<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;
use Modules\Address\Database\Seeders\AddressDatabaseSeeder;
use Modules\Category\Database\Seeders\CategoryDatabaseSeeder;
use Modules\Subcategory\Database\Seeders\SubcategoryDatabaseSeeder;

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
            CategoryDatabaseSeeder::class,
            SubcategoryDatabaseSeeder::class,
            AddressDatabaseSeeder::class,
            UserDatabaseSeeder::class,
        ]);
    }
}
