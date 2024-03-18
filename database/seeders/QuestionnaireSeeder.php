<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use App\Models\Questionnaire;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $timespan = [
            'S1',
            'S2',
            'Q1',
            'Q2',
            'Q3',
            'Q4',
        ];
           for ($i = 1; $i < 30; $i++) {

            $userId = User::where('role_id', 2)->inRandomOrder()->first()->id;
            $randomTimespan = $timespan[array_rand($timespan)];
            $randomYear = $faker->numberBetween(2018, 2024);

            Questionnaire::create([
                'name' => 'Questionnaire title ' . $i,
                'year' => $randomYear,
                'timespan' => $randomTimespan,
                'user_id' => 1,
            ]);
        }
    }
}
