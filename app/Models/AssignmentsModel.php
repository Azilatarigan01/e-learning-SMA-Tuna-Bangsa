<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AssignmentsModel extends Model
{
    use HasFactory;

    protected $table = 'assignments';
    protected $fillable = ['teacher_id', 'class_name', 'subject_name', 'assignments_date', 'submission_date', 'document', 'description'];

    public static function getSingle($id)
    {
        return self::find($id);
    }
    public static function getRecord()
    {
        $query = self::select('assignments.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by_name')
            ->leftJoin('users', 'users.id', '=', 'assignments.created_by')
            ->leftJoin('class', 'class.id', '=', 'assignments.class_id')
            ->leftJoin('subject', 'subject.id', '=', 'assignments.subject_id')
            ->where('assignments.is_delete', '=', 0)
            ->orderBy('assignments.id', 'desc');
    
        return $query->get();
    }
    

    public static function getMyAssignments($teacher_id)
{
    return self::select('assignments.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by_name')
        ->join('users', 'users.id', '=', 'assignments.created_by')
        ->join('class', 'class.id', '=', 'assignments.class_id')
        ->join('subject', 'subject.id', '=', 'assignments.subject_id')
        ->where('assignments.is_delete', 0)
        ->where('users.id', $teacher_id)
        ->orderByDesc('assignments.id')
        ->get();
}

public function getDocumentUrlAttribute()
{
    return !empty($this->document_file) ? url('upload/assignments/' . $this->document_file) : "";
}
}