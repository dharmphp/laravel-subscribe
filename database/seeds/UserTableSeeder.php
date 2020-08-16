<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        User::truncate();

        $faker = \Faker\Factory::create();

        $password = Hash::make('LaraSub#16');

        // Generate a application Admin
        User::create([
            'name' => 'Administrator',
            'type' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('L$Admin#16'),
        ]);

        // Generate a few subscriber for application
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'type' => 'subscriber',
                'email' => $faker->email,
                'password' => $password,
            ]);
        }
    }
}
