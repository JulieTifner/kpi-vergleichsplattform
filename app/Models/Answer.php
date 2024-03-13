<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'questionnaire_id', 'question_id'];


    public function questionnaire(){

        return $this->belongsTo(Questionnaire::class, 'questionnaire_id');
    }

    public function question(){

        return $this->belongsTo(Question::class, 'question_id');
    }
}
