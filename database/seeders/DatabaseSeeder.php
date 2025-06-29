<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\ProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => 'admin',
        ]);

        DB::table('categories')->insert([
            ['name' => 'Новые'],
            ['name' => 'Популярные'],
            ['name' => 'Акционные'],
        ]);

        new ProductSeeder()->run();

        //Product::factory(20)->create();
    }
}
