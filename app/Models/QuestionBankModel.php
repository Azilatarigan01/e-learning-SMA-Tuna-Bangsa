<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBankModel extends Model
{
    use HasFactory;

    protected $table = 'question_banks';

    protected $fillable = [
        'subject_id',
        'class_id',
        'created_by',
        'question_text',
        'question_type',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'option_e',
        'correct_answer',
        'explanation',
        'marks',
        'status',
        'is_delete',
    ];

    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function getQuestionsBySubject($subjectId = null, $classId = null)
    {
        $query = self::with(['subject', 'classModel', 'author'])
            ->where('is_delete', 0)
            ->orderBy('id', 'desc');

        if ($subjectId) {
            $query->where('subject_id', $subjectId);
        }
        if ($classId) {
            $query->where('class_id', $classId);
        }

        return $query->get();
    }
}
