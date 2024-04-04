<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Category;
use App\Models\Heating;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        // Disable foreign key checks
//        DB::statement('SET FOREIGN_KEY_CHECKS=0');
//
//        // Truncate the table
//        DB::table('properties')->truncate();
//
//        // Enable foreign key checks
//        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $faker = Factory::create();

        $categoryIds = Category::pluck('id')->toArray();
        $addressIds = Address::pluck('id')->toArray();
        $heatingIds = Heating::pluck('id')->toArray();
        $sellerIds = User::pluck('id')->toArray();

        for ($i = 0; $i < 45; $i++) {
            $property = [
                'title' => $faker->sentence,
                'description' => $faker->text,
                'area' => $faker->numberBetween(100, 300),
                'type' => $faker->randomElement(['For Sale', 'For Rent']),
                'floors' => $faker->numberBetween(1, 5),
                'rooms' => $faker->numberBetween(1, 5),
                'bathrooms' => $faker->numberBetween(1, 3),
                'featured' => $faker->boolean,
                'active' => true,
                'category_id' => $faker->randomElement($categoryIds),
                'address_id' => $faker->randomElement($addressIds),
                'heating_id' => $faker->randomElement($heatingIds),
                'seller_id' => $faker->randomElement($sellerIds)
            ];

            $price = $this->generatePrice($property, $faker->randomFloat(2, 100000, 20000000));
            $property["price"] = $price;

            Property::create($property);
        }
    }

    protected function generatePrice($property, $basePrice) {
        if ($property['type'] === 'For Rent'){
            return min($basePrice / 1000, 2000);
        }

        return $basePrice;
    }
}
