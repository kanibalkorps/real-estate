<?php

namespace Database\Seeders;

use App\Models\Heating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heatingNames = ["Central", "Electric", "Gas", "Wood"];

        foreach ($heatingNames as $heatingName) {
            Heating::create(['name' => $heatingName]);
        }
    }
}
