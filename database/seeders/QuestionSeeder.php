<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 30; $i++) {
    
            Question::create([
                'name' => 'Question ' . $i,
                'is_active' => rand(0,1),
                'type' => rand(0,1)

            ]);
        }
    }
}
