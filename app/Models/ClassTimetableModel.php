<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTimetableModel extends Model
{
    use HasFactory;

    protected $table = 'class_timetables';

    protected $fillable = [
        'academic_year_id',
        'class_id',
        'subject_id',
        'teacher_id',
        'room_id',
        'day_of_week',
        'start_time',
        'end_time',
        'status',
    ];

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

    public function room()
    {
        return $this->belongsTo(RoomModel::class, 'room_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYearModel::class, 'academic_year_id');
    }

    /**
     * Anti-Conflict Detection Engine (PRD Section 9)
     * Checks if teacher, class, or room has overlapping schedule.
     *
     * @return string|null Error message if conflict found, or null if schedule is safe.
     */
    public static function checkConflicts($teacherId, $classId, $roomId, $dayOfWeek, $startTime, $endTime, $ignoreId = null)
    {
        // 1. Check Teacher Conflict
        $teacherConflictQuery = self::with(['classModel', 'subjectModel', 'teacher'])
            ->where('teacher_id', $teacherId)
            ->where('day_of_week', $dayOfWeek)
            ->where('status', 0)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->where('start_time', '<', $endTime)
                  ->where('end_time', '>', $startTime);
            });

        if ($ignoreId) {
            $teacherConflictQuery->where('id', '!=', $ignoreId);
        }

        $teacherConflict = $teacherConflictQuery->first();
        if ($teacherConflict) {
            $tName = $teacherConflict->teacher->name ?? 'Guru bersangkutan';
            $cName = $teacherConflict->classModel->name ?? 'kelas lain';
            return "Bentrok Guru: {$tName} sudah memiliki jadwal mengajar di {$cName} pada hari {$dayOfWeek} pukul {$teacherConflict->start_time} - {$teacherConflict->end_time}.";
        }

        // 2. Check Class Conflict
        $classConflictQuery = self::with(['subjectModel', 'classModel'])
            ->where('class_id', $classId)
            ->where('day_of_week', $dayOfWeek)
            ->where('status', 0)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->where('start_time', '<', $endTime)
                  ->where('end_time', '>', $startTime);
            });

        if ($ignoreId) {
            $classConflictQuery->where('id', '!=', $ignoreId);
        }

        $classConflict = $classConflictQuery->first();
        if ($classConflict) {
            $cName = $classConflict->classModel->name ?? 'Kelas';
            $sName = $classConflict->subjectModel->name ?? 'mata pelajaran lain';
            return "Bentrok Kelas: {$cName} sudah memiliki jadwal {$sName} pada hari {$dayOfWeek} pukul {$classConflict->start_time} - {$classConflict->end_time}.";
        }

        // 3. Check Room Conflict
        $roomConflictQuery = self::with(['room', 'classModel', 'subjectModel'])
            ->where('room_id', $roomId)
            ->where('day_of_week', $dayOfWeek)
            ->where('status', 0)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->where('start_time', '<', $endTime)
                  ->where('end_time', '>', $startTime);
            });

        if ($ignoreId) {
            $roomConflictQuery->where('id', '!=', $ignoreId);
        }

        $roomConflict = $roomConflictQuery->first();
        if ($roomConflict) {
            $rName = $roomConflict->room->name ?? 'Ruangan';
            $cName = $roomConflict->classModel->name ?? 'kelas lain';
            $sName = $roomConflict->subjectModel->name ?? 'mapel lain';
            return "Bentrok Ruangan: {$rName} sedang digunakan oleh {$cName} ({$sName}) pada hari {$dayOfWeek} pukul {$roomConflict->start_time} - {$roomConflict->end_time}.";
        }

        return null;
    }

    /**
     * Get Timetable grouped by Day of Week for a Class
     */
    public static function getTimetableByClass($classId)
    {
        return self::with(['subjectModel', 'teacher', 'room'])
            ->where('class_id', $classId)
            ->where('status', 0)
            ->orderByRaw("FIELD(day_of_week, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('start_time', 'asc')
            ->get()
            ->groupBy('day_of_week');
    }

    /**
     * Get Timetable grouped by Day of Week for a Teacher
     */
    public static function getTimetableByTeacher($teacherId)
    {
        return self::with(['classModel', 'subjectModel', 'room'])
            ->where('teacher_id', $teacherId)
            ->where('status', 0)
            ->orderByRaw("FIELD(day_of_week, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('start_time', 'asc')
            ->get()
            ->groupBy('day_of_week');
    }
}
