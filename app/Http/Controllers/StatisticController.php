<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    /**
     * Retrieves and categorizes questions based on their type along with their answers for selected questionnaire.
     *
     * @param string $id
     * @return \Illuminate\Contracts\View\View 
     */
    public function index(string $id)
    {
        $questionsWithAnswer = Question::whereHas('answer', function ($query) {
            $query->whereNotNull('name');
        })->with(['answer' => function ($query) use ($id) {
            $query->where('questionnaire_id', $id);
        }])->get();

        $questionTypePercent = [];
        $questionTypeNum = [];

        foreach ($questionsWithAnswer as $q) {
            foreach ($q->answer as $answer) {
                $questionAnswerPair = [
                    'questionName' => $answer->question->name,
                    'answerName'   => $answer->name,
                ];

                if ($answer->question->type == 1) {
                    $questionTypePercent[] = $questionAnswerPair;
                } else {
                    $questionTypeNum[] = $questionAnswerPair;
                }
            }
        }

        $calcAverage = $this->compareAnswers();


        return view('user.statistics', [
            'questionsWithAnswer' => $questionsWithAnswer,
            'questionTypePercent' => $questionTypePercent,
            'questionTypeNum'     => $questionTypeNum,
            'calcAverage'         => $calcAverage,
        ]);
    }


    /**
     * Calculates the average values for answers to each question, differentiating between types.
     *
     * @return array
     */
    public function compareAnswers(){
        
        $questionsWithAnswers = Question::whereHas('answer', function ($query){
            $query->whereNotNull('name');
        })->with('answer')->get();

        $results = [];
        
        foreach($questionsWithAnswers as $q){
            $total = 0;
            $count = 0;
            $averagePercent = 0;
            $averageNum = 0;

            foreach($q->answer as $answer){
                $total += $answer->name;
                $count++;
            }

            if ($count > 0) {
                if ($q->type == 1) {
                    $averagePercent = $total / $count;
                } else {
                    $averageNum = $total / $count;
                }
            }
            $results[] = [
                'questionName' => $q->name,
                'averagePercent' => $averagePercent,
                'averageNum'    => $averageNum
            ];
        }
        return $results;
    }
}
