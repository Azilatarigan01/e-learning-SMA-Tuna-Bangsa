<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\AssignClassTeacherModel;
use App\Models\RoomModel;
use App\Models\User;
use App\Models\ClassTimetableModel;
use App\Models\InAppNotificationModel;
use Illuminate\Support\Facades\Auth;

class TimetableController extends Controller
{
    /**
     * Admin view and manage class weekly timetable.
     */
    public function adminList(Request $request)
    {
        $classes = ClassModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        $selectedClassId = $request->get('class_id') ?: ($classes->first()->id ?? null);
        $selectedClass = ClassModel::find($selectedClassId);

        $timetableByDay = collect();
        if ($selectedClassId) {
            $timetableByDay = ClassTimetableModel::getTimetableByClass($selectedClassId);
        }

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        $stats = [
            'total_slots' => ClassTimetableModel::where('status', 0)->count(),
            'class_slots' => $selectedClassId ? ClassTimetableModel::where('class_id', $selectedClassId)->where('status', 0)->count() : 0,
            'total_rooms' => RoomModel::count(),
            'total_teachers' => User::where('user_type', 2)->where('is_delete', 0)->count(),
        ];

        $data = [
            'header_title' => 'Jadwal Pelajaran KBM & Anti-Bentrok',
            'classes' => $classes,
            'selectedClassId' => $selectedClassId,
            'selectedClass' => $selectedClass,
            'timetableByDay' => $timetableByDay,
            'days' => $days,
            'stats' => $stats,
        ];

        return view('admin.timetable.list', $data);
    }

    /**
     * Admin create schedule slot form.
     */
    public function adminAdd(Request $request)
    {
        $classes = ClassModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        $subjects = SubjectModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        $teachers = User::where('user_type', 2)->where('is_delete', 0)->orderBy('name', 'asc')->get();
        $rooms = RoomModel::where('status', 0)->orderBy('name', 'asc')->get();

        $selectedClassId = $request->get('class_id');

        $data = [
            'header_title' => 'Tambah Slot Jadwal Pelajaran',
            'classes' => $classes,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'rooms' => $rooms,
            'selectedClassId' => $selectedClassId,
            'days' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        ];

        return view('admin.timetable.add', $data);
    }

    /**
     * Admin store new schedule slot with Conflict Detection Validation.
     */
    public function adminInsert(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'room_id' => 'required|integer',
            'day_of_week' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ], [
            'end_time.after' => 'Waktu selesai harus lebih besar daripada waktu mulai.',
        ]);

        $conflict = ClassTimetableModel::checkConflicts(
            $request->teacher_id,
            $request->class_id,
            $request->room_id,
            $request->day_of_week,
            $request->start_time,
            $request->end_time
        );

        if ($conflict) {
            return redirect()->back()->withInput()->with('error', $conflict);
        }

        ClassTimetableModel::create([
            'academic_year_id' => 1,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'room_id' => $request->room_id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 0,
        ]);

        // Kirim notifikasi jadwal baru kepada Guru yang ditugaskan (PRD Kriteria 9)
        try {
            InAppNotificationModel::create([
                'user_id' => $request->teacher_id,
                'sender_id' => Auth::id() ?: 1,
                'title' => 'Pembaruan Jadwal Pelajaran',
                'message' => "Jadwal mengajar baru ditambahkan pada hari {$request->day_of_week} pukul {$request->start_time} - {$request->end_time}.",
                'url' => route('teacher.timetable'),
                'type' => 'timetable',
                'is_read' => 0,
            ]);
        } catch (\Exception $e) {
            // Abaikan jika error log notifikasi
        }

        return redirect()->route('admin.timetable.list', ['class_id' => $request->class_id])
            ->with('success', 'Jadwal pelajaran berhasil ditambahkan! Sistem validasi memastikan tidak ada bentrok guru, kelas, maupun ruangan.');
    }

    /**
     * Admin delete schedule slot.
     */
    public function adminDelete($id)
    {
        $schedule = ClassTimetableModel::findOrFail($id);
        $classId = $schedule->class_id;
        $schedule->delete();

        return redirect()->route('admin.timetable.list', ['class_id' => $classId])
            ->with('success', 'Slot jadwal pelajaran berhasil dihapus.');
    }

    /**
     * Teacher weekly teaching timetable.
     */
    public function teacherTimetable(Request $request)
    {
        $teacherId = Auth::user()->id;
        $timetableByDay = ClassTimetableModel::getTimetableByTeacher($teacherId);
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        $totalTeachingHours = ClassTimetableModel::where('teacher_id', $teacherId)->where('status', 0)->count();

        $data = [
            'header_title' => 'Jadwal Mengajar Mingguan Saya',
            'timetableByDay' => $timetableByDay,
            'days' => $days,
            'totalTeachingHours' => $totalTeachingHours,
        ];

        return view('teacher.timetable.index', $data);
    }

    /**
     * Student weekly class timetable.
     */
    public function studentTimetable(Request $request)
    {
        $student = Auth::user();
        $class = ClassModel::find($student->class_id);
        $timetableByDay = collect();

        if ($student->class_id) {
            $timetableByDay = ClassTimetableModel::getTimetableByClass($student->class_id);
        }

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        $data = [
            'header_title' => 'Jadwal Pelajaran Mingguan Saya',
            'student' => $student,
            'class' => $class,
            'timetableByDay' => $timetableByDay,
            'days' => $days,
        ];

        return view('student.timetable.index', $data);
    }
}
