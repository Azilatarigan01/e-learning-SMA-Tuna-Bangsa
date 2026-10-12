<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Import model User

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class';

    static public function getRecord()
    {
        return self::select('class.*')
                    ->where('class.is_delete', '=', 0)
                    ->orderBy('class.id', 'desc')
                    ->get();
    }

    

    public function softDelete()
    {
        $this->is_delete = 1;
        $this->save();
    }

    static public function getClass()
    {
        return ClassModel::select('class.*')
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->orderBy('class.name', 'asc')
            ->get();
    }

    public function assignedTeachers()
    {
        return $this->hasMany(AssignClassTeacherModel::class, 'class_id');
    }

    public function assignments()
    {
        return $this->hasMany(AssignmentsModel::class, 'class_id');
    }
}
