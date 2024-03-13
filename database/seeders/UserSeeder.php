<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = [
            [
                'username' => 'user',
                'password' => '12345678',
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'moderator',
                'password' => '12345678',
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        foreach ($users as $user) {
            User::create($user);
        }

        foreach (range(1, 6) as $index) {
            DB::table('users')->insert([
                'username' => $faker->firstname,
                'password' => bcrypt('password'),
                'role_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
