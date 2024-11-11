<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrators',
            'email' => 'admin@example.com',
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin54@example.com',
        ]);

        // Call other seeders
        $this->call(TvShowSeeder::class);
    }
}
