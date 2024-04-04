<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryNames = ["Apartment", "Villa", "House", "Office", "Building", "Shop"];

        foreach ($categoryNames as $categoryName) {
            Category::create(['name' => $categoryName]);
        }
    }
}
