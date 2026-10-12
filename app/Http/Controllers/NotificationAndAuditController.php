<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InAppNotificationModel;
use App\Models\ActivityLogModel;
use App\Models\StudentGradeModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationAndAuditController extends Controller
{
    // ==========================================
    // 1. PUSAT NOTIFIKASI PENGGUNA (IN-APP NOTIFICATIONS)
    // ==========================================

    public function notificationsIndex()
    {
        $user = Auth::user();
        $notifications = InAppNotificationModel::getMyNotifications($user->id, 50);

        $data = [
            'header_title' => 'Pusat Notifikasi & Pemberitahuan Saya',
            'notifications' => $notifications,
        ];

        return view('notifications.index', $data);
    }

    public function markAllNotificationsRead()
    {
        InAppNotificationModel::where('user_id', Auth::id())->update(['is_read' => 1]);
        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai sebagai sudah dibaca.');
    }

    public function markNotificationReadAndRedirect($id)
    {
        $notif = InAppNotificationModel::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $notif->is_read = 1;
        $notif->save();

        if ($notif->url) {
            return redirect($notif->url);
        }

        return redirect()->back();
    }

    // ==========================================
    // 2. JEJAK AUDIT & RIWAYAT AKTIVITAS (ADMIN)
    // ==========================================

    public function adminActivityLogs(Request $request)
    {
        $query = ActivityLogModel::with('user')->orderBy('id', 'desc');

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        $logs = $query->limit(100)->get();

        $data = [
            'header_title' => 'Jejak Audit & Riwayat Aktivitas Sistem',
            'logs' => $logs,
            'selectedModule' => $request->module,
            'selectedAction' => $request->action,
        ];

        return view('admin.activity_logs.index', $data);
    }

    // ==========================================
    // 3. CETAK DOKUMEN RESMI (RAPOR & LEGER PRINT-READY)
    // ==========================================

    public function printStudentReportCard($studentId = null)
    {
        if (!$studentId) {
            if (Auth::user() && Auth::user()->user_type == 3) {
                $studentId = Auth::id();
            } else {
                $studentId = User::where('user_type', 3)->where('is_delete', 0)->value('id') ?: Auth::id();
            }
        }

        $student = User::with('classModel')->findOrFail($studentId);
        $grades = StudentGradeModel::with('subject')
            ->where('student_id', $studentId)
            ->get();

        $gpa = StudentGradeModel::getStudentGPA($studentId);

        $data = [
            'header_title' => 'Cetak Rapor Digital: ' . $student->name,
            'student' => $student,
            'grades' => $grades,
            'gpa' => $gpa,
        ];

        return view('print.report_card', $data);
    }

    public function printMasterLeger($classId)
    {
        $class = ClassModel::findOrFail($classId);
        $students = User::where('user_type', 3)
            ->where('class_id', $classId)
            ->where('is_delete', 0)
            ->orderBy('name', 'asc')
            ->get();

        $subjects = SubjectModel::select('subject.id', 'subject.name')
            ->join('class_subject', 'class_subject.subject_id', '=', 'subject.id')
            ->where('class_subject.class_id', $classId)
            ->where('class_subject.is_delete', 0)
            ->orderBy('subject.name', 'asc')
            ->get();

        $gradesMatrix = [];
        foreach ($students as $stu) {
            $stuGrades = StudentGradeModel::where('student_id', $stu->id)->get()->keyBy('subject_id');
            $gradesMatrix[$stu->id] = $stuGrades;
        }

        $data = [
            'header_title' => 'Cetak Buku Induk Leger Nilai: ' . $class->name,
            'class' => $class,
            'students' => $students,
            'subjects' => $subjects,
            'gradesMatrix' => $gradesMatrix,
        ];

        return view('print.master_leger', $data);
    }
}
