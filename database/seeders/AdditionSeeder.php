<?php

namespace Database\Seeders;

use App\Models\Addition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $additionNames = ["balcony", "terrace", "yard", "basement", "pool", "garage", "parking"];

        foreach ($additionNames as $additionName) {
            Addition::create(['name' => $additionName]);
        }
    }
}
