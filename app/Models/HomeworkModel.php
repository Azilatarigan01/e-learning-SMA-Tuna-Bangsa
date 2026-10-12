<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeworkModel extends Model
{
    use HasFactory;

    protected $table = 'homework';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getRecord()
    {
        $return = HomeworkModel::select('homework.*', 'class.name as class_name', 'subject.name as subject_name', )
                ->join('class', 'class.id', '=', 'homework.class_id')
                ->join('subject', 'subject.id', '=', 'homework.subject_id')
                ->orderBy('homework.id', 'desc')
                ->paginate(20);
        return $return;
    }
    public static function getRecordTeacher($class_ids)
    {
        $return = HomeworkModel::select('homework.*', 'class.name as class_name', 'subject.name as subject_name',)
                ->join('class', 'class.id', '=', 'homework.class_id')
                ->join('subject', 'subject.id', '=', 'homework.subject_id')
                ->whereIn('homework.class_id', $class_ids)
                ->orderBy('homework.id', 'desc')
                ->paginate(20);
        return $return;
    }

    public static function getRecordStudent($class_id, $student_id)
    {
        return HomeworkModel::select('homework.*', 'class.name as class_name', 'subject.name as subject_name',)
                ->join('class', 'class.id', '=', 'homework.class_id')
                ->join('subject', 'subject.id', '=', 'homework.subject_id')
                ->where('homework.class_id', '=', $class_id)
                ->whereNotIn('homework.id', function($query) use ($student_id){
                    $query->select('homework_submit.homework_id')
                            ->from('homework_submit')
                            ->where('homework_submit.student_id', '=', $student_id);
                })
                ->orderBy('homework.id', 'desc')
                ->paginate(20);
    }

    public function getDocument()
    {
        if(!empty($this->document_file) && file_exists(public_path('upload/homework/'.$this->document_file)))
        {
            return url('upload/homework/'.$this->document_file);
        }
        else
        {
            return "";
        }
    }
}
