<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Modules\Address\Entities\City;
use Modules\Product\Entities\Product;
use Modules\Address\Entities\Barangay;
use Illuminate\Database\Eloquent\Model;
use Modules\Business\Entities\Business;
use Modules\Category\Entities\Category;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        app()['cache']->forget('spatie.permission.cache');

        User::factory(100)->create()->each(function($user) {

            $role = Arr::random(["owner", "customer"]);

            $user->assignRole($role);

            if ($role == "owner") {

                // Create Business
                Business::factory(5)->create([

                    'user_id' => $user->id,

                ])->each(function($business) {

                    $cities = City::where('provCode', 619)->get();
                    $city = $cities->random();
                    $business->city_id = $city->citymunCode;

                    $barangays = Barangay::where('citymunCode', $city->citymunCode)->get();
                    $barangay = $barangays->random();
                    $business->barangay_id = $barangay->brgyCode;

                    $street = fake()->streetName();
                    $business->street = $street;

                    $business->full_address = $street . ', ' . $barangay->brgyDesc . ', ' . ucwords(Str::lower($city->citymunDesc)) . ', Capiz';

                    // Add Category and Subcategory
                    $category_id = rand(1, 15);
                    $business->category_id = $category_id;
                    $business->save();

                    $business->subcategories()->attach(Category::find($category_id)->subcategories->random(3));

                    // Add Product
                    Product::factory(3)->create([
                        'business_id' => $business->id
                    ]);

                    // Add Service
                    // Service::factory(1)->create([
                    //     'business_id' => $business->id
                    // ]);
                });
            }
        });
    }
}
