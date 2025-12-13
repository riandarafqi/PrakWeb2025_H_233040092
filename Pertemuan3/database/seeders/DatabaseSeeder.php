<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
/**
 * Seed the application's database.
 */
public function run(): void
{
    // Membuat 10 User secara manual dengan username user1-user10
    for ($i = 1; $i <= 10; $i++) {
        User::create([
            'name' => 'User ' . $i,
            'username' => 'user' . $i,
            'email' => 'user' . $i . '@example.com',
            'password' => bcrypt('password'),
        ]);
    }

    // Membuat Category secara otomatis
    // 2 categories
    Category::factory(2)->create();

    // Membuat Post secara otomatis (akan otomatis assign ke user dan category yang ada)
    // 10 post
    Post::factory(10)
        ->recycle(User::all())
        ->recycle(Category::all())
        ->create();
}}