<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
