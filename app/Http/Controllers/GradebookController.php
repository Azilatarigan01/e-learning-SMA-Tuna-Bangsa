<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\AssignClassTeacherModel;
use App\Models\StudentGradeModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GradebookController extends Controller
{
    /**
     * Teacher Gradebook input sheet.
     */
    public function teacherIndex(Request $request)
    {
        $teacherId = Auth::user()->id;

        // Get classes assigned to this teacher
        $classes = ClassModel::select('class.id', 'class.name')
            ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class.id')
            ->where('assign_class_teacher.teacher_id', $teacherId)
            ->where('assign_class_teacher.status', 0)
            ->where('assign_class_teacher.is_delete', 0)
            ->where('class.is_delete', 0)
            ->distinct()
            ->orderBy('class.name', 'asc')
            ->get();

        // If teacher has no assigned classes, fallback to all active classes for demo
        if ($classes->isEmpty()) {
            $classes = ClassModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        }

        $selectedClassId = $request->get('class_id') ?: ($classes->first()->id ?? null);

        // Get subjects for selected class
        $subjects = [];
        if ($selectedClassId) {
            $subjects = SubjectModel::select('subject.id', 'subject.name', 'subject.type')
                ->join('class_subject', 'class_subject.subject_id', '=', 'subject.id')
                ->where('class_subject.class_id', $selectedClassId)
                ->where('class_subject.is_delete', 0)
                ->where('class_subject.status', 0)
                ->where('subject.is_delete', 0)
                ->where('subject.status', 0)
                ->orderBy('subject.name', 'asc')
                ->get();
        }

        $selectedSubjectId = $request->get('subject_id') ?: ($subjects->first()->id ?? null);

        $students = [];
        $existingGrades = collect();
        $stats = [
            'total_students' => 0,
            'graded_students' => 0,
            'average_score' => 0,
            'highest_score' => 0,
            'lowest_score' => 0,
            'pass_count' => 0,
            'fail_count' => 0,
            'pass_rate' => 0,
        ];

        if ($selectedClassId) {
            $students = User::where('class_id', $selectedClassId)
                ->where('user_type', 3)
                ->where('is_delete', 0)
                ->orderByRaw('CAST(roll_number AS UNSIGNED) ASC')
                ->orderBy('name', 'asc')
                ->get();

            $stats['total_students'] = $students->count();

            if ($selectedSubjectId) {
                $existingGrades = StudentGradeModel::where('class_id', $selectedClassId)
                    ->where('subject_id', $selectedSubjectId)
                    ->get()
                    ->keyBy('student_id');

                if ($existingGrades->isNotEmpty()) {
                    $stats['graded_students'] = $existingGrades->count();
                    $stats['average_score'] = round($existingGrades->avg('final_score'), 1);
                    $stats['highest_score'] = round($existingGrades->max('final_score'), 1);
                    $stats['lowest_score'] = round($existingGrades->min('final_score'), 1);
                    $stats['pass_count'] = $existingGrades->where('passing_status', 1)->count();
                    $stats['fail_count'] = $existingGrades->where('passing_status', 0)->count();
                    $stats['pass_rate'] = $stats['graded_students'] > 0 
                        ? round(($stats['pass_count'] / $stats['graded_students']) * 100, 1) 
                        : 0;
                }
            }
        }

        $data = [
            'header_title' => 'Buku Nilai & Asesmen Siswa',
            'classes' => $classes,
            'subjects' => $subjects,
            'selectedClassId' => $selectedClassId,
            'selectedSubjectId' => $selectedSubjectId,
            'students' => $students,
            'existingGrades' => $existingGrades,
            'stats' => $stats,
        ];

        return view('teacher.gradebook.index', $data);
    }

    /**
     * Teacher Submit Batch Grades.
     */
    public function teacherSubmit(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'grades' => 'required|array',
        ]);

        $teacherId = Auth::user()->id;
        $classId = (int) $request->class_id;
        $subjectId = (int) $request->subject_id;

        foreach ($request->grades as $studentId => $row) {
            $hw = isset($row['homework_score']) && $row['homework_score'] !== '' ? (float) $row['homework_score'] : null;
            $quiz = isset($row['quiz_score']) && $row['quiz_score'] !== '' ? (float) $row['quiz_score'] : null;
            $mid = isset($row['midterm_score']) && $row['midterm_score'] !== '' ? (float) $row['midterm_score'] : null;
            $finalExam = isset($row['final_exam_score']) && $row['final_exam_score'] !== '' ? (float) $row['final_exam_score'] : null;
            $notes = $row['competency_notes'] ?? '';

            if ($hw !== null || $quiz !== null || $mid !== null || $finalExam !== null) {
                $finalScore = StudentGradeModel::computeFinalScore($hw ?? 0, $quiz ?? 0, $mid ?? 0, $finalExam ?? 0);
                $gradeLetter = StudentGradeModel::computeGradeLetter($finalScore);
                $passingStatus = StudentGradeModel::computePassingStatus($finalScore);

                StudentGradeModel::updateOrCreate(
                    [
                        'class_id' => $classId,
                        'subject_id' => $subjectId,
                        'student_id' => (int) $studentId,
                    ],
                    [
                        'teacher_id' => $teacherId,
                        'academic_year_id' => 1,
                        'homework_score' => $hw,
                        'quiz_score' => $quiz,
                        'midterm_score' => $mid,
                        'final_exam_score' => $finalExam,
                        'final_score' => $finalScore,
                        'grade_letter' => $gradeLetter,
                        'passing_status' => $passingStatus,
                        'competency_notes' => $notes,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Nilai asesmen siswa berhasil disimpan dan dikalkulasi secara otomatis!');
    }

    /**
     * Teacher Class Grade Recapitulation & Rank Report.
     */
    public function teacherReport(Request $request)
    {
        $teacherId = Auth::user()->id;

        $classes = ClassModel::select('class.id', 'class.name')
            ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class.id')
            ->where('assign_class_teacher.teacher_id', $teacherId)
            ->where('assign_class_teacher.status', 0)
            ->where('assign_class_teacher.is_delete', 0)
            ->where('class.is_delete', 0)
            ->distinct()
            ->orderBy('class.name', 'asc')
            ->get();

        if ($classes->isEmpty()) {
            $classes = ClassModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        }

        $selectedClassId = $request->get('class_id') ?: ($classes->first()->id ?? null);

        $subjects = [];
        if ($selectedClassId) {
            $subjects = SubjectModel::select('subject.id', 'subject.name')
                ->join('class_subject', 'class_subject.subject_id', '=', 'subject.id')
                ->where('class_subject.class_id', $selectedClassId)
                ->where('class_subject.is_delete', 0)
                ->where('subject.is_delete', 0)
                ->orderBy('subject.name', 'asc')
                ->get();
        }

        $selectedSubjectId = $request->get('subject_id') ?: ($subjects->first()->id ?? null);

        $grades = collect();
        if ($selectedClassId && $selectedSubjectId) {
            $grades = StudentGradeModel::with(['student', 'classModel', 'subjectModel'])
                ->where('class_id', $selectedClassId)
                ->where('subject_id', $selectedSubjectId)
                ->orderByDesc('final_score')
                ->get();
        }

        $data = [
            'header_title' => 'Rekapitulasi & Ranking Nilai Siswa',
            'classes' => $classes,
            'subjects' => $subjects,
            'selectedClassId' => $selectedClassId,
            'selectedSubjectId' => $selectedSubjectId,
            'grades' => $grades,
        ];

        return view('teacher.gradebook.report', $data);
    }

    /**
     * Student Digital Report Card (Rapor Digital Siswa).
     */
    public function studentReportCard(Request $request)
    {
        $student = Auth::user();
        $class = ClassModel::find($student->class_id);

        $grades = StudentGradeModel::with(['subjectModel', 'teacher'])
            ->where('student_id', $student->id)
            ->orderBy('id', 'asc')
            ->get();

        $stats = [
            'total_subjects' => $grades->count(),
            'gpa' => $grades->isNotEmpty() ? round($grades->avg('final_score'), 2) : 0,
            'passed_count' => $grades->where('passing_status', 1)->count(),
            'remedial_count' => $grades->where('passing_status', 0)->count(),
            'grade_counts' => [
                'A' => $grades->where('grade_letter', 'A')->count(),
                'B' => $grades->where('grade_letter', 'B')->count(),
                'C' => $grades->where('grade_letter', 'C')->count(),
                'D' => $grades->where('grade_letter', 'D')->count(),
            ]
        ];

        $data = [
            'header_title' => 'Rapor Akademik Digital Siswa',
            'student' => $student,
            'class' => $class,
            'grades' => $grades,
            'stats' => $stats,
        ];

        return view('student.gradebook.report_card', $data);
    }

    /**
     * Admin School Leger & Master Gradebook Report.
     */
    public function adminLeger(Request $request)
    {
        $classes = ClassModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        $subjects = SubjectModel::where('is_delete', 0)->orderBy('name', 'asc')->get();

        $selectedClassId = $request->get('class_id');
        $selectedSubjectId = $request->get('subject_id');

        $query = StudentGradeModel::with(['student', 'classModel', 'subjectModel', 'teacher']);

        if (!empty($selectedClassId)) {
            $query->where('class_id', $selectedClassId);
        }
        if (!empty($selectedSubjectId)) {
            $query->where('subject_id', $selectedSubjectId);
        }

        $grades = $query->orderBy('class_id', 'asc')
            ->orderBy('subject_id', 'asc')
            ->orderByDesc('final_score')
            ->paginate(40)
            ->withQueryString();

        $overallStats = [
            'total_entries' => StudentGradeModel::count(),
            'overall_avg' => round(StudentGradeModel::avg('final_score') ?: 0, 1),
            'total_pass' => StudentGradeModel::where('passing_status', 1)->count(),
            'total_remedial' => StudentGradeModel::where('passing_status', 0)->count(),
        ];

        $data = [
            'header_title' => 'Buku Nilai & Leger Akademik Sekolah',
            'classes' => $classes,
            'subjects' => $subjects,
            'selectedClassId' => $selectedClassId,
            'selectedSubjectId' => $selectedSubjectId,
            'grades' => $grades,
            'overallStats' => $overallStats,
        ];

        return view('admin.gradebook.report', $data);
    }
}
