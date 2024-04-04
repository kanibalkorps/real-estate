<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageNames = ["property-1", "property-2", "property-3", "property-4", "property-5", "property-6"];
//        $basePath = asset("assets/theme/img");

        foreach ($imageNames as $imageName) {
            DB::table("images")->insert([
                "name" => $imageName,
            ]);
        }
    }
}
