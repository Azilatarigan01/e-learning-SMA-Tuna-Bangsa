<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassDiscussionModel extends Model
{
    use HasFactory;

    protected $table = 'class_discussions';

    protected $fillable = [
        'class_id',
        'subject_id',
        'user_id',
        'title',
        'content',
        'is_pinned',
        'status',
    ];

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subjectModel()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(ClassDiscussionReplyModel::class, 'discussion_id')->orderBy('created_at', 'asc');
    }

    public static function getDiscussionsByClassSubject($classId, $subjectId = null)
    {
        $query = self::with(['author', 'subjectModel', 'replies.author'])
            ->where('class_id', $classId)
            ->where('status', 0)
            ->orderBy('is_pinned', 'desc')
            ->orderBy('id', 'desc');

        if ($subjectId) {
            $query->where('subject_id', $subjectId);
        }

        return $query->get();
    }
}
