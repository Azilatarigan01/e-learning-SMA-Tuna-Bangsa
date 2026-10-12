<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtStudentAnswerModel extends Model
{
    use HasFactory;

    protected $table = 'cbt_student_answers';

    protected $fillable = [
        'attempt_id',
        'question_id',
        'student_answer',
        'is_correct',
        'score_awarded',
    ];

    public function attempt()
    {
        return $this->belongsTo(CbtStudentAttemptModel::class, 'attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(QuestionBankModel::class, 'question_id');
    }
}
