<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $categories = [
            'Business Services',
            'Computers & Internet',
            'Entertainment & Media',
            'Events & Conferences',
            'Finances & Insurance',
            'Food & Drink',
            'Health & Beauty',
            'Legal',
            'Manufacturing & Industry',
            'Shopping',
            'Tourism & Accommodation',
            'Tradesmen & Construction',
            'Transport & Motoring',
            'Public & Social Services',
            'Property',
        ];

        foreach ($categories as $category) {

            $category = Category::create([
                'name' => $category
            ]);
        }
    }
}
