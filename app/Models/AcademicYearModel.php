<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYearModel extends Model
{
    use HasFactory;

    protected $table = 'academic_years';

    protected $fillable = [
        'name',
        'semester',
        'is_active',
        'start_date',
        'end_date'
    ];

    public static function getRecord()
    {
        return self::orderBy('id', 'desc')->get();
    }

    public static function getActiveSemester()
    {
        return self::where('is_active', 1)->first();
    }

    public static function getSingle($id)
    {
        return self::find($id);
    }
}
