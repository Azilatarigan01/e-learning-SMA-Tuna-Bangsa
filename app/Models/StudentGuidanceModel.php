<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGuidanceModel extends Model
{
    use HasFactory;

    protected $table = 'student_guidances';

    protected $fillable = [
        'student_id',
        'homeroom_teacher_id',
        'class_id',
        'category',
        'date',
        'title',
        'description',
        'action_taken',
        'follow_up_status',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function homeroomTeacher()
    {
        return $this->belongsTo(User::class, 'homeroom_teacher_id');
    }

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public static function getByClass($classId)
    {
        return self::with(['student', 'homeroomTeacher'])
            ->where('class_id', $classId)
            ->orderBy('date', 'desc')
            ->get();
    }

    public static function getByStudent($studentId)
    {
        return self::with(['homeroomTeacher', 'classModel'])
            ->where('student_id', $studentId)
            ->orderBy('date', 'desc')
            ->get();
    }
}
