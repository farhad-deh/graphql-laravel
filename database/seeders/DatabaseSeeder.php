<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Restaurant;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(1)->admin()->create();
        User::factory()->count(5)->create();
        User::factory()->count(2)->viewer()->create();

        $restaurants = Restaurant::factory()->count(3)->create();

        foreach ($restaurants as $restaurant) {
            Food::factory()->count(random_int(1, 10))->create([
                'restaurant_id' => $restaurant->id,
            ]);
        }
    }
}
