<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SubjectModel extends Model
{
    use HasFactory;

    // Pastikan nama tabel sesuai dengan nama yang ada di database
    protected $table = 'subject';

    // Mendapatkan semua record yang tidak dihapus
    static public function getRecord()
    {
        return self::select('subject.*', 'users.name as created_by_name')
                    ->join('users', 'users.id', '=', 'subject.created_by')
                    ->where('subject.is_delete', '=', 0)
                    ->orderBy('subject.id', 'desc')
                    ->get();
    }

    // Relasi dengan tabel users
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Soft delete
    public function softDelete()
    {
        $this->is_delete = 1;
        $this->save();
    }

    // Mendapatkan semua subject yang tidak dihapus dan aktif
    static public function getSubject()
    {
        return self::select('subject.*')
                    ->join('users', 'users.id', '=', 'subject.created_by')
                    ->where('subject.is_delete', '=', 0)
                    ->where('subject.status', '=', 0)
                    ->orderBy('subject.name', 'asc')
                    ->get();
    }

    public function assignments()
    {
        return $this->hasMany(AssignmentsModel::class, 'subject_id');
    }

}
