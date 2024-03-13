<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
    
            $questionnaireId = Questionnaire::inRandomOrder()->first()->id;

            $question = Question::inRandomOrder()->first();
            $questionId = $question->id;

            if ($question->type) {
                // Für 'type' == true, zufällige Prozentzahl zwischen 0 und 100
                $answerValue = rand(0, 100);
            } else {
                // Für 'type' == false, zufällige Zahl zwischen 0 und 100
                $answerValue = rand(1, 100);
            }

            Answer::create([
                'name' =>  $answerValue,
                'questionnaire_id' => $questionnaireId,
                'question_id' => $questionId
            ]);
        }
    }
}
