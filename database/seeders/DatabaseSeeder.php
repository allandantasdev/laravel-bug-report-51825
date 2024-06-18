<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Example;
use App\Models\Permission;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create();

        $categories = [Category::query()->create(['user_id' => $user->id, 'name' => 'Category 1']),
            Category::query()->create(['user_id' => $user->id, 'name' => 'Category 2']),
                Category::query()->create(['user_id' => $user->id, 'name' => 'Category 3']),
        ];

        Example::insert([
            ['category_id' => $categories[0]->id, 'name' => 'Example 1', 'restricted' => false],
            ['category_id' => $categories[1]->id, 'name' => 'Example 2', 'restricted' => true],
            ['category_id' => $categories[2]->id, 'name' => 'Example 3', 'restricted' => false],
            ['category_id' => $categories[2]->id, 'name' => 'Example 4', 'restricted' => false],
            ['category_id' => $categories[2]->id, 'name' => 'Example 5', 'restricted' => true],
        ]);

        User::factory()->create(); // another user just for demonstration
    }
}
