<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtracurricularModel extends Model
{
    use HasFactory;

    protected $table = 'extracurriculars';

    protected $fillable = [
        'name',
        'category',
        'teacher_id',
        'day_of_week',
        'start_time',
        'end_time',
        'location',
        'quota',
        'status',
        'description',
        'icon',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function members()
    {
        return $this->hasMany(ExtracurricularMemberModel::class, 'extracurricular_id');
    }

    public function activeMembers()
    {
        return $this->hasMany(ExtracurricularMemberModel::class, 'extracurricular_id')->where('status', 0);
    }

    public static function getRecord()
    {
        return self::with(['teacher', 'members.student'])
            ->orderBy('id', 'asc')
            ->get();
    }

    public static function getSingle($id)
    {
        return self::with(['teacher', 'members.student'])->find($id);
    }

    public static function getActiveEkskul()
    {
        return self::where('status', 0)
            ->with(['teacher', 'members'])
            ->orderBy('name', 'asc')
            ->get();
    }
}
