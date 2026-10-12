<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtracurricularMemberModel extends Model
{
    use HasFactory;

    protected $table = 'extracurricular_members';

    protected $fillable = [
        'extracurricular_id',
        'student_id',
        'role',
        'status',
        'notes',
    ];

    public function extracurricular()
    {
        return $this->belongsTo(ExtracurricularModel::class, 'extracurricular_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public static function getMembersByEkskul($ekskulId)
    {
        return self::where('extracurricular_id', $ekskulId)
            ->with('student')
            ->orderBy('role', 'asc')
            ->get();
    }

    public static function getEkskulByStudent($studentId)
    {
        return self::where('student_id', $studentId)
            ->with(['extracurricular.teacher'])
            ->get();
    }
}
