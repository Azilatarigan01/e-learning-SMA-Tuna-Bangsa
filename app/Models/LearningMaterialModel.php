<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningMaterialModel extends Model
{
    use HasFactory;

    protected $table = 'learning_materials';

    protected $fillable = [
        'class_id',
        'subject_id',
        'created_by',
        'title',
        'meeting_number',
        'description',
        'document_file',
        'video_url',
        'is_published',
        'is_delete'
    ];

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subjectModel()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function getSingle($id)
    {
        return self::where('is_delete', 0)
            ->with(['classModel', 'subjectModel', 'teacher'])
            ->find($id);
    }

    public static function getRecordAdmin($class_id = null, $subject_id = null)
    {
        $query = self::where('is_delete', 0)
            ->with(['classModel', 'subjectModel', 'teacher'])
            ->orderBy('id', 'desc');

        if (!empty($class_id)) {
            $query->where('class_id', $class_id);
        }
        if (!empty($subject_id)) {
            $query->where('subject_id', $subject_id);
        }

        return $query->get();
    }

    public static function getRecordTeacher($teacher_id, $class_id = null, $subject_id = null)
    {
        $query = self::where('created_by', $teacher_id)
            ->where('is_delete', 0)
            ->with(['classModel', 'subjectModel'])
            ->orderBy('id', 'desc');

        if (!empty($class_id)) {
            $query->where('class_id', $class_id);
        }
        if (!empty($subject_id)) {
            $query->where('subject_id', $subject_id);
        }

        return $query->get();
    }

    public static function getRecordStudent($class_id, $subject_id = null)
    {
        $query = self::where('class_id', $class_id)
            ->where('is_published', 1)
            ->where('is_delete', 0)
            ->with(['subjectModel', 'teacher'])
            ->orderBy('id', 'desc');

        if (!empty($subject_id)) {
            $query->where('subject_id', $subject_id);
        }

        return $query->get();
    }

    public function getDocument()
    {
        if (!empty($this->document_file) && file_exists(public_path('upload/materials/' . $this->document_file))) {
            return url('upload/materials/' . $this->document_file);
        }
        return "";
    }
}
