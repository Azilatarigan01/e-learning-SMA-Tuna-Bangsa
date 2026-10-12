<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtExamQuestionModel extends Model
{
    use HasFactory;

    protected $table = 'cbt_exam_questions';

    protected $fillable = [
        'cbt_exam_id',
        'question_id',
        'sort_order',
    ];

    public function exam()
    {
        return $this->belongsTo(CbtExamModel::class, 'cbt_exam_id');
    }

    public function question()
    {
        return $this->belongsTo(QuestionBankModel::class, 'question_id');
    }
}
