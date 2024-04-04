<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countryNames = ["Serbia"];

        foreach ($countryNames as $countryName) {
            Country::create(['name' => $countryName]);
        }
    }
}
