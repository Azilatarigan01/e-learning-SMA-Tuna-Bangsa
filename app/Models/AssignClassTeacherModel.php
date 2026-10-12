<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignClassTeacherModel extends Model
{
    protected $table = 'assign_class_teacher';

    protected $fillable = [
        'class_id',
        'teacher_id',
        'status',
        'created_at',
        'updated_at'
    ];

    public static function getRecord()
    {
        return self::select('assign_class_teacher.*', 'class.name as class_name', 'teacher.name as teacher_name')
            ->join('users as teacher', 'teacher.id', '=', 'assign_class_teacher.teacher_id')
            ->join('class', 'class.id', '=', 'assign_class_teacher.class_id')
            ->orderByDesc('assign_class_teacher.id')
            ->get();
    }

    public static function getMyClassSubject($teacher_id)
{
    return self::select('assign_class_teacher.*', 'class.name as class_name', 'subject.name as subject_name', 'subject.type as subject_type')
        ->join('class', 'class.id', '=', 'assign_class_teacher.class_id')
        ->join('class_subject', 'class_subject.class_id', '=', 'class.id')
        ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
        ->where('assign_class_teacher.is_delete', 0)
        ->where('assign_class_teacher.status', 0)
        ->where('subject.status', 0)
        ->where('class_subject.status', 0)
        ->where('assign_class_teacher.teacher_id', $teacher_id)
        ->orderByDesc('assign_class_teacher.id')
        ->get();
}
 public static function getMyClassSubjectGroup($teacher_id)
 {
    return AssignClassTeacherModel::select('assign_class_teacher.*', 'class.name as class_name', 'class.id as class_id',)
            ->join('class', 'class.id', '=', 'assign_class_teacher.class_id')
            ->where('assign_class_teacher.status', '=', 0)
            ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
            ->groupBy('assign_class_teacher.class_id')
            ->get();
 }

}
