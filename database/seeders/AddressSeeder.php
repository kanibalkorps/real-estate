<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $cities = City::pluck('id');
        $countries = Country::pluck('id');

        for ($i = 0; $i < 10; $i++) {
            Address::create([
                'street' => "Street " . $faker->name(),
                'number' => rand(1, 400),
                'city_id' => $cities->random(),
                'country_id' => $countries->random(),
            ]);
        }
    }
}
