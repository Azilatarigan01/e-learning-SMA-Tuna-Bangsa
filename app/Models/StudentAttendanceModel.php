<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendanceModel extends Model
{
    use HasFactory;

    protected $table = 'student_attendances';

    const STATUS_HADIR = 1;
    const STATUS_SAKIT = 2;
    const STATUS_IZIN = 3;
    const STATUS_ALPA = 4;

    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id',
        'student_id',
        'attendance_date',
        'meeting_number',
        'attendance_status',
        'notes',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subjectModel()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public static function getAttendanceBySession($class_id, $subject_id, $attendance_date)
    {
        return self::where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->where('attendance_date', $attendance_date)
            ->get()
            ->keyBy('student_id');
    }

    public static function getStudentHistory($student_id, $subject_id = null)
    {
        $query = self::where('student_id', $student_id)
            ->with(['subjectModel', 'teacher', 'classModel'])
            ->orderBy('attendance_date', 'desc')
            ->orderBy('id', 'desc');

        if (!empty($subject_id)) {
            $query->where('subject_id', $subject_id);
        }

        return $query->get();
    }

    public static function getStudentSummary($student_id, $subject_id = null)
    {
        $records = self::where('student_id', $student_id);
        if (!empty($subject_id)) {
            $records->where('subject_id', $subject_id);
        }
        $records = $records->get();

        $total = $records->count();
        $hadir = $records->where('attendance_status', self::STATUS_HADIR)->count();
        $sakit = $records->where('attendance_status', self::STATUS_SAKIT)->count();
        $izin = $records->where('attendance_status', self::STATUS_IZIN)->count();
        $alpa = $records->where('attendance_status', self::STATUS_ALPA)->count();
        $percentage = $total > 0 ? round(($hadir / $total) * 100, 1) : 100;

        return [
            'total' => $total,
            'hadir' => $hadir,
            'sakit' => $sakit,
            'izin' => $izin,
            'alpa' => $alpa,
            'percentage' => $percentage,
        ];
    }

    public static function getAdminReport($class_id = null, $subject_id = null, $attendance_date = null)
    {
        $query = self::with(['student', 'classModel', 'subjectModel', 'teacher'])
            ->orderBy('attendance_date', 'desc')
            ->orderBy('id', 'desc');

        if (!empty($class_id)) {
            $query->where('class_id', $class_id);
        }
        if (!empty($subject_id)) {
            $query->where('subject_id', $subject_id);
        }
        if (!empty($attendance_date)) {
            $query->where('attendance_date', $attendance_date);
        }

        return $query->get();
    }
}
