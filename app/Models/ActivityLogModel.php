<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLogModel extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'module',
        'action',
        'description',
        'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function log($userId, $module, $action, $description, $ip = null)
    {
        return self::create([
            'user_id' => $userId,
            'module' => $module,
            'action' => $action,
            'description' => $description,
            'ip_address' => $ip ?: request()->ip(),
        ]);
    }
}
