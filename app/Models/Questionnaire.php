<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'year', 'timespan', 'user_id'];

    public function user(){

        return $this->belongsTo(User::class, 'user_id');
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }
}
