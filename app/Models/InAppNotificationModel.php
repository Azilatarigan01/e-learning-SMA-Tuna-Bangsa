<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InAppNotificationModel extends Model
{
    use HasFactory;

    protected $table = 'in_app_notifications';

    protected $fillable = [
        'user_id',
        'sender_id',
        'title',
        'message',
        'url',
        'type',
        'is_read',
    ];

    public function recipient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public static function getUnreadCount($userId)
    {
        return self::where('user_id', $userId)->where('is_read', 0)->count();
    }

    public static function getMyNotifications($userId, $limit = 20)
    {
        return self::where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();
    }
}
