<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentStudentModel;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\StudentGradeModel;
use App\Models\StudentAttendanceModel;
use App\Models\ClassTimetableModel;
use App\Models\NoticeBoardModel;
use App\Models\HomeworkModel;
use Illuminate\Support\Facades\Auth;

class ParentController extends Controller
{
    /**
     * Parent Portal Dashboard (PRD Section 3 & 11)
     */
    public function dashboard(Request $request)
    {
        $parent = Auth::user();
        $parentStudents = ParentStudentModel::getStudentsByParent($parent->id);

        $selectedStudentId = $request->get('student_id') ?: ($parentStudents->first()->student_id ?? null);
        $student = $selectedStudentId ? User::find($selectedStudentId) : null;
        $class = $student ? ClassModel::find($student->class_id) : null;

        $stats = [
            'gpa' => 0,
            'total_subjects' => 0,
            'attendance_rate' => 100,
            'present_count' => 0,
            'sick_count' => 0,
            'permission_count' => 0,
            'absent_count' => 0,
        ];

        $grades = collect();
        $attendances = collect();
        $timetables = collect();
        $notices = NoticeBoardModel::where('status', 0)->orderBy('notice_date', 'desc')->take(5)->get();

        if ($student) {
            $grades = StudentGradeModel::where('student_id', $student->id)->with(['subjectModel', 'teacher'])->get();
            if ($grades->isNotEmpty()) {
                $stats['gpa'] = round($grades->avg('final_score'), 1);
                $stats['total_subjects'] = $grades->count();
            }

            $attendances = StudentAttendanceModel::where('student_id', $student->id)->get();
            if ($attendances->isNotEmpty()) {
                $stats['present_count'] = $attendances->where('attendance_status', 1)->count();
                $stats['sick_count'] = $attendances->where('attendance_status', 3)->count();
                $stats['permission_count'] = $attendances->where('attendance_status', 2)->count();
                $stats['absent_count'] = $attendances->where('attendance_status', 4)->count();
                $total = $attendances->count();
                $stats['attendance_rate'] = $total > 0 ? round(($stats['present_count'] / $total) * 100, 1) : 100;
            }

            if ($student->class_id) {
                $timetables = ClassTimetableModel::getTimetableByClass($student->class_id);
            }
        }

        $data = [
            'header_title' => 'Portal Orang Tua Siswa',
            'parent' => $parent,
            'parentStudents' => $parentStudents,
            'student' => $student,
            'class' => $class,
            'stats' => $stats,
            'grades' => $grades,
            'timetables' => $timetables,
            'notices' => $notices,
            'days' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
        ];

        return view('parent.dashboard', $data);
    }

    /**
     * Parent view student report card & grades.
     */
    public function myStudentGrades(Request $request)
    {
        $parent = Auth::user();
        $parentStudents = ParentStudentModel::getStudentsByParent($parent->id);
        $selectedStudentId = $request->get('student_id') ?: ($parentStudents->first()->student_id ?? null);
        $student = $selectedStudentId ? User::find($selectedStudentId) : null;
        $class = $student ? ClassModel::find($student->class_id) : null;

        $grades = collect();
        if ($student) {
            $grades = StudentGradeModel::where('student_id', $student->id)->with(['subjectModel', 'teacher'])->get();
        }

        $data = [
            'header_title' => 'Capaian Nilai & Rapor Anak',
            'parentStudents' => $parentStudents,
            'student' => $student,
            'class' => $class,
            'grades' => $grades,
        ];

        return view('parent.grades', $data);
    }

    /**
     * Parent view student attendance history.
     */
    public function myStudentAttendance(Request $request)
    {
        $parent = Auth::user();
        $parentStudents = ParentStudentModel::getStudentsByParent($parent->id);
        $selectedStudentId = $request->get('student_id') ?: ($parentStudents->first()->student_id ?? null);
        $student = $selectedStudentId ? User::find($selectedStudentId) : null;
        $class = $student ? ClassModel::find($student->class_id) : null;

        $attendances = collect();
        if ($student) {
            $attendances = StudentAttendanceModel::where('student_id', $student->id)
                ->with(['subjectModel', 'teacher'])
                ->orderBy('attendance_date', 'desc')
                ->paginate(20);
        }

        $data = [
            'header_title' => 'Riwayat Presensi & Kehadiran Anak',
            'parentStudents' => $parentStudents,
            'student' => $student,
            'class' => $class,
            'attendances' => $attendances,
        ];

        return view('parent.attendance', $data);
    }

    /**
     * Parent view student class timetable.
     */
    public function myStudentTimetable(Request $request)
    {
        $parent = Auth::user();
        $parentStudents = ParentStudentModel::getStudentsByParent($parent->id);
        $selectedStudentId = $request->get('student_id') ?: ($parentStudents->first()->student_id ?? null);
        $student = $selectedStudentId ? User::find($selectedStudentId) : null;
        $class = $student ? ClassModel::find($student->class_id) : null;

        $timetables = collect();
        if ($student && $student->class_id) {
            $timetables = ClassTimetableModel::getTimetableByClass($student->class_id);
        }

        $data = [
            'header_title' => 'Jadwal Pelajaran KBM Anak',
            'parentStudents' => $parentStudents,
            'student' => $student,
            'class' => $class,
            'timetables' => $timetables,
            'days' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
        ];

        return view('parent.timetable', $data);
    }
}
