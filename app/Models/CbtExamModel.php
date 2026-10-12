<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtExamModel extends Model
{
    use HasFactory;

    protected $table = 'cbt_exams';

    protected $fillable = [
        'title',
        'class_id',
        'subject_id',
        'created_by',
        'duration_minutes',
        'start_time',
        'end_time',
        'passing_grade',
        'instructions',
        'is_published',
        'is_delete',
    ];

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function examQuestions()
    {
        return $this->hasMany(CbtExamQuestionModel::class, 'cbt_exam_id')->orderBy('sort_order', 'asc');
    }

    public function attempts()
    {
        return $this->hasMany(CbtStudentAttemptModel::class, 'cbt_exam_id');
    }
}
