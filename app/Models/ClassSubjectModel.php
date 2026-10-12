<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectModel extends Model
{
    use HasFactory;

    protected $table = 'class_subject';

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }

    public static function getRecord()
    {
        return self::select('class_subject.*', 'class.name as class_name', 'subject.name as subject_name')
            ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
            ->join('class', 'class.id', '=', 'class_subject.class_id')
            ->orderByDesc('class_subject.id')
            ->get();
    }
    
    public static function MySubject($class_id)
    {
        return self::select('class_subject.*', 'subject.name as subject_name', 'subject.type as subject_type')
            ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
            ->join('class', 'class.id', '=', 'class_subject.class_id')
            ->where('class_subject.class_id', '=', $class_id)
            ->orderBy('subject.name', 'asc')
            ->get();
    }
    

    public function updateRecord($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function deleteRecord()
    {
        $this->delete();
    }
}
