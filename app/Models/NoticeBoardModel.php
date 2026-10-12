<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeBoardModel extends Model
{
    use HasFactory;

    protected $table = 'notice_board';

    protected $fillable = [
        'title',
        'notice_date',
        'publish_date',
        'message',
        'message_to',
        'target_class_id',
        'created_by_id',
        'priority',
        'status',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function targetClass()
    {
        return $this->belongsTo(ClassModel::class, 'target_class_id');
    }

    public static function getNoticesForUser($user)
    {
        $query = self::with(['author', 'targetClass'])
            ->where('status', 0)
            ->orderBy('notice_date', 'desc')
            ->orderBy('id', 'desc');

        if ($user->user_type == 1) {
            // Admin sees all
            return $query->get();
        } elseif ($user->user_type == 2) {
            // Teacher sees 'all' and 'teacher' notices
            return $query->where(function ($q) {
                $q->where('message_to', 'all')
                  ->orWhere('message_to', 'teacher');
            })->get();
        } elseif ($user->user_type == 3) {
            // Student sees 'all', 'student', and notices targeted to their class
            return $query->where(function ($q) use ($user) {
                $q->where('message_to', 'all')
                  ->orWhere('message_to', 'student');
            })->where(function ($q) use ($user) {
                $q->whereNull('target_class_id')
                  ->orWhere('target_class_id', $user->class_id);
            })->get();
        }

        return $query->get();
    }
}
