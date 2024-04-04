<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

//        $roleIds = DB::table("roles")->pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            $user = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'role_id' => 1,
            ];

            User::create($user);
        }

        User::create([
            'name' => "User",
            'email' => "birisicmartin02@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt('sifra111'),
            'role_id' => 1,
        ]);
        User::create([
            'name' => "Admin",
            'email' => "martin.birisic@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt('sifra111'),
            'role_id' => 2,
        ]);
    }
}
