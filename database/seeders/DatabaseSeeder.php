<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorYSeeder::class,
            NoteSeeder::class,
            NoteCategorySeeder::class,
        ]);

        Category::factory()->count(10)->create();
    }
}
