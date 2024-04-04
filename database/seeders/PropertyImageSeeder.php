<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PropertyImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $propertyIds = DB::table('properties')->pluck('id')->toArray();
        $imageIds = DB::table('images')->pluck('id')->toArray();

        foreach ($propertyIds as $propertyId){
            DB::table('properties_images')->insert([
                'property_id' => $propertyId,
                'image_id' => Arr::random($imageIds)
            ]);
        }
    }
}
