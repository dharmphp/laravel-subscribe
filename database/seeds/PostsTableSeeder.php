<?php

use Illuminate\Database\Seeder;
use App\{Post, User};

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();

        $faker = \Faker\Factory::create();

        $admin = User::whereType('admin')->first();
        if($admin instanceof User) {
            for ($i = 0; $i < 20; $i++) {
                Post::create([
                    'user_id' => $admin->id,
                    'title' => $faker->sentence,
                    'description' => $faker->paragraph,
                ]);
            }
        } else {
            throw \Exception("Admin User Not found! Please create admin user before creating Posts");
        }
    }
}
