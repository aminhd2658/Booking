<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin account by default
        User::factory()->create([
            'name' => 'Amin Heydari',
            'email' => 'aminhd1378@gmail.com',
            'role' => User::ADMIN
        ]);


        // Create countries
        foreach (range(1, 200) as $index) {
            $countryName = fake()->country();
            while (Country::where('name', $countryName)->first()) {
                $countryName = fake()->country();
            }
            Country::create([
                'name' => $countryName,
            ]);
        }
    }
}
