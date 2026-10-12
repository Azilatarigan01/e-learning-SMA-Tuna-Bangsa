<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAttendanceModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    // ==========================================
    // TEACHER ACTIONS
    // ==========================================
    public function teacherIndex(Request $request)
    {
        $teacherId = Auth::user()->id;
        
        // Ambil kelas yang ditugaskan ke guru ini
        $assignedClassIds = \DB::table('assign_class_teacher')
            ->where('teacher_id', $teacherId)
            ->where('is_delete', 0)
            ->pluck('class_id');

        $data['getClass'] = ClassModel::whereIn('id', $assignedClassIds)
            ->where('is_delete', 0)
            ->where('status', 0)
            ->orderBy('name', 'asc')
            ->get();

        $data['class_id'] = $request->get('class_id');
        $data['subject_id'] = $request->get('subject_id');
        $data['attendance_date'] = $request->get('attendance_date', date('Y-m-d'));
        $data['meeting_number'] = $request->get('meeting_number', 'Pertemuan 1');

        $data['getSubject'] = [];
        $data['getStudents'] = [];
        $data['existingAttendance'] = [];

        if (!empty($data['class_id'])) {
            $data['getSubject'] = ClassSubjectModel::MySubject($data['class_id']);

            if (!empty($data['subject_id']) && !empty($data['attendance_date'])) {
                $data['getStudents'] = User::where('class_id', $data['class_id'])
                    ->where('user_type', 3)
                    ->where('is_delete', 0)
                    ->orderByRaw('CAST(roll_number AS UNSIGNED) ASC')
                    ->orderBy('name', 'asc')
                    ->get();

                $data['existingAttendance'] = StudentAttendanceModel::getAttendanceBySession(
                    $data['class_id'],
                    $data['subject_id'],
                    $data['attendance_date']
                );
            }
        }

        $data['header_title'] = "Presensi & Kehadiran Siswa";
        return view('teacher.attendance.take', $data);
    }

    public function teacherSubmit(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'attendance_date' => 'required|date',
            'meeting_number' => 'required|string',
            'attendance' => 'required|array',
        ]);

        $teacherId = Auth::user()->id;
        $class_id = $request->class_id;
        $subject_id = $request->subject_id;
        $attendance_date = $request->attendance_date;
        $meeting_number = trim($request->meeting_number);

        foreach ($request->attendance as $student_id => $status) {
            $notes = isset($request->notes[$student_id]) ? trim($request->notes[$student_id]) : null;

            StudentAttendanceModel::updateOrCreate(
                [
                    'class_id' => $class_id,
                    'subject_id' => $subject_id,
                    'student_id' => $student_id,
                    'attendance_date' => $attendance_date,
                ],
                [
                    'teacher_id' => $teacherId,
                    'meeting_number' => $meeting_number,
                    'attendance_status' => (int) $status,
                    'notes' => $notes,
                ]
            );
        }

        return redirect()->back()->with('success', 'Presensi siswa berhasil disimpan untuk tanggal ' . date('d M Y', strtotime($attendance_date)) . ' (' . $meeting_number . ').');
    }

    public function teacherReport(Request $request)
    {
        $teacherId = Auth::user()->id;

        $assignedClassIds = \DB::table('assign_class_teacher')
            ->where('teacher_id', $teacherId)
            ->where('is_delete', 0)
            ->pluck('class_id');

        $data['getClass'] = ClassModel::whereIn('id', $assignedClassIds)
            ->where('is_delete', 0)
            ->where('status', 0)
            ->orderBy('name', 'asc')
            ->get();

        $data['class_id'] = $request->get('class_id');
        $data['subject_id'] = $request->get('subject_id');

        $data['getSubject'] = [];
        $data['studentsReport'] = [];

        if (!empty($data['class_id'])) {
            $data['getSubject'] = ClassSubjectModel::MySubject($data['class_id']);

            if (!empty($data['subject_id'])) {
                $students = User::where('class_id', $data['class_id'])
                    ->where('user_type', 3)
                    ->where('is_delete', 0)
                    ->orderByRaw('CAST(roll_number AS UNSIGNED) ASC')
                    ->get();

                $report = [];
                foreach ($students as $s) {
                    $summary = StudentAttendanceModel::getStudentSummary($s->id, $data['subject_id']);
                    $report[] = [
                        'student' => $s,
                        'summary' => $summary,
                    ];
                }
                $data['studentsReport'] = $report;
            }
        }

        $data['header_title'] = "Rekapitulasi Kehadiran Kelas";
        return view('teacher.attendance.report', $data);
    }

    // ==========================================
    // STUDENT ACTIONS
    // ==========================================
    public function studentIndex(Request $request)
    {
        $student = Auth::user();
        $studentId = $student->id;
        $classId = $student->class_id;

        $data['subject_id'] = $request->get('subject_id');
        $data['getSubject'] = ClassSubjectModel::MySubject($classId);

        $data['summary'] = StudentAttendanceModel::getStudentSummary($studentId, $data['subject_id']);
        $data['history'] = StudentAttendanceModel::getStudentHistory($studentId, $data['subject_id']);

        $data['header_title'] = "Riwayat Presensi & Kehadiran Saya";
        return view('student.attendance.index', $data);
    }

    // ==========================================
    // ADMIN ACTIONS
    // ==========================================
    public function adminReport(Request $request)
    {
        $class_id = $request->get('class_id');
        $subject_id = $request->get('subject_id');
        $attendance_date = $request->get('attendance_date');

        $data['getRecord'] = StudentAttendanceModel::getAdminReport($class_id, $subject_id, $attendance_date);
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getRecord();

        // Statistik sekolah
        $total = $data['getRecord']->count();
        $hadir = $data['getRecord']->where('attendance_status', 1)->count();
        $sakit = $data['getRecord']->where('attendance_status', 2)->count();
        $izin = $data['getRecord']->where('attendance_status', 3)->count();
        $alpa = $data['getRecord']->where('attendance_status', 4)->count();
        $persen = $total > 0 ? round(($hadir / $total) * 100, 1) : 100;

        $data['stats'] = [
            'total' => $total,
            'hadir' => $hadir,
            'sakit' => $sakit,
            'izin' => $izin,
            'alpa' => $alpa,
            'persen' => $persen,
        ];

        $data['header_title'] = "Rekapitulasi Presensi Sekolah";
        return view('admin.attendance.report', $data);
    }
}
