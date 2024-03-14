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
                $answerValue = rand(0, 100);
            } else {
                $answerValue = rand(0, 1000);
            }

            Answer::create([
                'name' =>  $answerValue,
                'questionnaire_id' => $questionnaireId,
                'question_id' => $questionId
            ]);
        }
    }
}
