<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Product;
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
        // Admin
        User::factory()->create([
            'name'     => 'Irfansyah',
            'email'    => 'irfansyah@gmail.com',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        // User biasa
        User::factory(5)->create([
            'role' => 'user',
        ]);

        // Categories harus dibuat lebih dulu (products butuh category_id)
        Categories::factory(7)->create();

        // Products dengan category_id dari categories yang sudah ada
        Product::factory(20)->create();
    }
}
