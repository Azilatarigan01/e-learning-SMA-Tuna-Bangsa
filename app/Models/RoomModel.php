<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'name',
        'type',
        'capacity',
        'status',
        'notes'
    ];

    public static function getRecord()
    {
        return self::orderBy('id', 'asc')->get();
    }

    public static function getAvailableRooms()
    {
        return self::where('status', 0)->orderBy('name', 'asc')->get();
    }

    public static function getSingle($id)
    {
        return self::find($id);
    }
}
