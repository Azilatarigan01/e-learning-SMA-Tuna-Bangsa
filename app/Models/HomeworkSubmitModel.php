<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeworkSubmitModel extends Model
{
    use HasFactory;

    protected $table = 'homework_submit';

    public static function getRecord($homework_id)
    {
        $return = HomeworkSubmitModel::select('homework_submit.*', 'users.name as first_name')
            ->join('users', 'users.id', '=', 'homework_submit.student_id')
            ->where('homework_submit.homework_id', $homework_id)
            ->orderBy('homework_submit.id', 'desc')
            ->paginate(50);
        return $return;
    }

    public static function getRecordStudent($student_id, $class_id)
    {
        $return = HomeworkSubmitModel::select('homework_submit.*', 'class.name as class_name', 'subject.name as subject_name')
            ->join('homework', 'homework.id', '=', 'homework_submit.homework_id')
            ->join('class', 'class.id', '=', 'homework.class_id')
            ->join('subject', 'subject.id', '=', 'homework.subject_id')
            ->where('homework.class_id', $class_id)
            ->where('homework_submit.student_id', $student_id)
            ->orderBy('homework_submit.id', 'desc')
            ->paginate(20);
        return $return;
    }

    public function getDocument()
    {
        if (!empty($this->document_file) && file_exists(public_path('upload/homework/'.$this->document_file))) {
            return url('upload/homework/'.$this->document_file);
        } else {
            return "";
        }
    }

    public function getHomework()
    {
        return $this->belongsTo(HomeworkModel::class, "homework_id");
    }

    public function getStudent()
    {
        return $this->belongsTo(User::class, "student_id");
    }
}
