<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtStudentAttemptModel extends Model
{
    use HasFactory;

    protected $table = 'cbt_student_attempts';

    protected $fillable = [
        'cbt_exam_id',
        'student_id',
        'started_at',
        'submitted_at',
        'total_score',
        'correct_count',
        'wrong_count',
        'status',
    ];

    public function exam()
    {
        return $this->belongsTo(CbtExamModel::class, 'cbt_exam_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function answers()
    {
        return $this->hasMany(CbtStudentAnswerModel::class, 'attempt_id');
    }
}
