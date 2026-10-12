<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password', // Tambahkan password ke $fillable agar bisa diperbarui
       
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get a user by ID.
     *
     * @param int $id
     * @return User|null
     */
    public static function getById($id)
    {
        return self::find($id);
    }

    /**
     * Get all admin users.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getAdmins()
    {
        return self::where('user_type', 1)
                        ->orderByDesc('id')
                        ->get();
    }
    

    /**
     * Get all student users with their class names.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getStudents()
    {
        return self::select('users.*', 'class.name as class_name')
                    ->leftJoin('class', 'class.id', '=', 'users.class_id')
                    ->where('users.user_type', 3)
                    ->where('users.is_delete', 0)
                    ->orderBy('users.id', 'desc')
                    ->paginate(10);
    }

    public static function getTeacherStudents($teacher_id)
    {
        return self::select('users.*', 'class.name as class_name')
                    ->leftJoin('class', 'class.id', '=', 'users.class_id')
                    ->leftJoin('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class.id')
                    ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
                    ->where('assign_class_teacher.status', '=', 0)
                    ->where('assign_class_teacher.is_delete', '=', 0)
                    ->where('users.user_type', 3)
                    ->where('users.is_delete', 0)
                    ->orderBy('users.id', 'desc')
                    ->groupBy('users.id')
                    ->paginate(10);
    }

    /**
     * Get all teacher users.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getTeacher()
    {
        return self::select('users.*')
                    ->where('users.user_type', 2)
                    ->where('users.is_delete', 0)
                    ->orderBy('users.id', 'desc')
                    ->paginate(10);
    }

    /**
     * Get all teacher users.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getTeacherClass()
    {
        return self::select('users.*')
                    ->where('users.user_type', 2) 
                    ->where('users.is_delete', 0) 
                    ->orderBy('users.id', 'desc')
                    ->get();
    }

    /**
     * Get a user by email.
     *
     * @param string $email
     * @return User|null
     */
    public static function getByEmail($email)
    {
        return self::where('email', '=', $email)->first();
    }

    /**
     * Get admin user by ID.
     *
     * @param int $id
     * @return User|null
     */
    public static function getAdminById($id)
    {
        return self::where('id', $id)
                    ->where('user_type', 1)
                    ->first();
    }

    /**
     * Relasi ke ClassModel untuk Siswa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    /**
     * Relasi ke ClassModel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'assign_class_teacher', 'teacher_id', 'class_id');
    }

    /**
     * Relasi ke SubjectModel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subject()
    {
        return $this->belongsToMany(SubjectModel::class, 'subject_teacher', 'teacher_id', 'subject_id');
    }
}
