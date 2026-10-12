<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassDiscussionReplyModel extends Model
{
    use HasFactory;

    protected $table = 'class_discussion_replies';

    protected $fillable = [
        'discussion_id',
        'user_id',
        'reply_text',
    ];

    public function discussion()
    {
        return $this->belongsTo(ClassDiscussionModel::class, 'discussion_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
