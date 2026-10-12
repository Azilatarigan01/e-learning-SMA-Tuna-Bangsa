<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoticeBoardModel;
use App\Models\StudentGuidanceModel;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\StudentAttendanceModel;
use App\Models\StudentGradeModel;
use App\Models\AssignClassTeacherModel;
use Illuminate\Support\Facades\Auth;

class NoticeBoardController extends Controller
{
    // ==========================================
    // NOTICE BOARD & ANNOUNCEMENT MODULE
    // ==========================================

    /**
     * Admin view list of announcements.
     */
    public function adminList(Request $request)
    {
        $query = NoticeBoardModel::with(['author', 'targetClass'])
            ->orderBy('notice_date', 'desc')
            ->orderBy('id', 'desc');

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $notices = $query->paginate(15)->withQueryString();

        $stats = [
            'total_notices' => NoticeBoardModel::count(),
            'urgent_notices' => NoticeBoardModel::where('priority', 'urgent')->count(),
            'school_wide' => NoticeBoardModel::where('message_to', 'all')->count(),
            'class_specific' => NoticeBoardModel::whereNotNull('target_class_id')->count(),
        ];

        $data = [
            'header_title' => 'Pengumuman & Informasi Sekolah',
            'notices' => $notices,
            'stats' => $stats,
        ];

        return view('admin.notice_board.list', $data);
    }

    /**
     * Admin create announcement form.
     */
    public function adminAdd()
    {
        $classes = ClassModel::where('is_delete', 0)->orderBy('name', 'asc')->get();

        $data = [
            'header_title' => 'Tambah Pengumuman Sekolah',
            'classes' => $classes,
        ];

        return view('admin.notice_board.add', $data);
    }

    /**
     * Admin store announcement.
     */
    public function adminInsert(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'notice_date' => 'required|date',
            'message' => 'required|string',
            'message_to' => 'required|string',
            'priority' => 'required|string',
        ]);

        NoticeBoardModel::create([
            'title' => $request->title,
            'notice_date' => $request->notice_date,
            'publish_date' => now()->toDateString(),
            'message' => $request->message,
            'message_to' => $request->message_to,
            'target_class_id' => $request->filled('target_class_id') ? $request->target_class_id : null,
            'created_by_id' => Auth::user()->id,
            'priority' => $request->priority,
            'status' => 0,
        ]);

        return redirect()->route('admin.notice_board.list')->with('success', 'Pengumuman sekolah berhasil diterbitkan!');
    }

    /**
     * Admin delete announcement.
     */
    public function adminDelete($id)
    {
        $notice = NoticeBoardModel::findOrFail($id);
        $notice->delete();

        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus.');
    }

    /**
     * Teacher view announcements.
     */
    public function teacherList(Request $request)
    {
        $user = Auth::user();
        $notices = NoticeBoardModel::getNoticesForUser($user);
        $classes = ClassModel::where('is_delete', 0)->orderBy('name', 'asc')->get();

        $data = [
            'header_title' => 'Papan Pengumuman & Informasi Guru',
            'notices' => $notices,
            'classes' => $classes,
        ];

        return view('teacher.notice_board.list', $data);
    }

    /**
     * Teacher post announcement to their class.
     */
    public function teacherPost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'notice_date' => 'required|date',
            'message' => 'required|string',
            'target_class_id' => 'required|integer',
            'priority' => 'required|string',
        ]);

        NoticeBoardModel::create([
            'title' => $request->title,
            'notice_date' => $request->notice_date,
            'publish_date' => now()->toDateString(),
            'message' => $request->message,
            'message_to' => 'student',
            'target_class_id' => $request->target_class_id,
            'created_by_id' => Auth::user()->id,
            'priority' => $request->priority,
            'status' => 0,
        ]);

        return redirect()->back()->with('success', 'Pengumuman kelas berhasil diterbitkan untuk siswa!');
    }

    /**
     * Student view announcements.
     */
    public function studentList(Request $request)
    {
        $user = Auth::user();
        $notices = NoticeBoardModel::getNoticesForUser($user);

        $data = [
            'header_title' => 'Papan Pengumuman & Informasi Sekolah',
            'notices' => $notices,
        ];

        return view('student.notice_board.list', $data);
    }

    // ==========================================
    // HOMEROOM & PASTORAL CARE MODULE (PRD Section 6)
    // ==========================================

    /**
     * Teacher view Homeroom Class (Kelas Binaan Wali Kelas).
     */
    public function teacherHomeroom(Request $request)
    {
        $teacher = Auth::user();

        // Get classes teacher is assigned to, or fallback to first class
        $assignedClasses = ClassModel::select('class.id', 'class.name')
            ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class.id')
            ->where('assign_class_teacher.teacher_id', $teacher->id)
            ->where('assign_class_teacher.status', 0)
            ->where('class.is_delete', 0)
            ->distinct()
            ->orderBy('class.name', 'asc')
            ->get();

        if ($assignedClasses->isEmpty()) {
            $assignedClasses = ClassModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        }

        $selectedClassId = $request->get('class_id') ?: ($assignedClasses->first()->id ?? 17);
        $selectedClass = ClassModel::find($selectedClassId);

        // 40 students in this homeroom class
        $students = User::where('class_id', $selectedClassId)
            ->where('user_type', 3)
            ->where('is_delete', 0)
            ->orderByRaw('CAST(roll_number AS UNSIGNED) ASC')
            ->orderBy('name', 'asc')
            ->get();

        // Guidance & pastoral records for this class
        $guidances = StudentGuidanceModel::getByClass($selectedClassId);

        // Quick academic & attendance stats for 40 students
        $classGrades = StudentGradeModel::where('class_id', $selectedClassId)->get();
        $classAvg = $classGrades->isNotEmpty() ? round($classGrades->avg('final_score'), 1) : 0;
        $totalPass = $classGrades->where('passing_status', 1)->count();

        $data = [
            'header_title' => 'Dashboard Wali Kelas: Kelas Binaan',
            'assignedClasses' => $assignedClasses,
            'selectedClassId' => $selectedClassId,
            'selectedClass' => $selectedClass,
            'students' => $students,
            'guidances' => $guidances,
            'classAvg' => $classAvg,
            'totalPass' => $totalPass,
        ];

        return view('teacher.homeroom.index', $data);
    }

    /**
     * Teacher store homeroom student pastoral/guidance note.
     */
    public function teacherStoreGuidance(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'class_id' => 'required|integer',
            'category' => 'required|string',
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'action_taken' => 'nullable|string',
            'follow_up_status' => 'required|string',
        ]);

        StudentGuidanceModel::create([
            'student_id' => $request->student_id,
            'homeroom_teacher_id' => Auth::user()->id,
            'class_id' => $request->class_id,
            'category' => $request->category,
            'date' => $request->date,
            'title' => $request->title,
            'description' => $request->description,
            'action_taken' => $request->action_taken,
            'follow_up_status' => $request->follow_up_status,
        ]);

        return redirect()->back()->with('success', 'Catatan pembinaan & perkembangan siswa berhasil disimpan!');
    }

    /**
     * Student view their own pastoral guidance & character recognition.
     */
    public function studentGuidance(Request $request)
    {
        $student = Auth::user();
        $guidances = StudentGuidanceModel::getByStudent($student->id);

        $data = [
            'header_title' => 'Catatan Pembinaan & Apresiasi Karakter',
            'guidances' => $guidances,
        ];

        return view('student.homeroom.index', $data);
    }

    /**
     * Admin view school-wide pastoral care & homeroom monitoring.
     */
    public function adminHomeroomReport(Request $request)
    {
        $classes = ClassModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        $selectedClassId = $request->get('class_id');

        $query = StudentGuidanceModel::with(['student', 'homeroomTeacher', 'classModel'])
            ->orderBy('date', 'desc');

        if (!empty($selectedClassId)) {
            $query->where('class_id', $selectedClassId);
        }

        $guidances = $query->paginate(20)->withQueryString();

        $stats = [
            'total_notes' => StudentGuidanceModel::count(),
            'achievement_notes' => StudentGuidanceModel::where('category', 'Prestasi')->count(),
            'academic_notes' => StudentGuidanceModel::where('category', 'Akademik')->count(),
            'counseling_referrals' => StudentGuidanceModel::where('follow_up_status', 'Rujukan BK')->count(),
        ];

        $data = [
            'header_title' => 'Rekap Pembinaan & Bimbingan Siswa Sekolah',
            'classes' => $classes,
            'selectedClassId' => $selectedClassId,
            'guidances' => $guidances,
            'stats' => $stats,
        ];

        return view('admin.homeroom.report', $data);
    }
}
