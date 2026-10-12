<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionBankModel;
use App\Models\CbtExamModel;
use App\Models\CbtExamQuestionModel;
use App\Models\CbtStudentAttemptModel;
use App\Models\CbtStudentAnswerModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CbtController extends Controller
{
    // ==========================================
    // 1. BANK SOAL (QUESTION BANK)
    // ==========================================

    public function questionBankList(Request $request)
    {
        $user = Auth::user();
        $subjectId = $request->get('subject_id');
        $classId = $request->get('class_id');

        $subjects = SubjectModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        $classes = ClassModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        $questions = QuestionBankModel::getQuestionsBySubject($subjectId, $classId);

        $data = [
            'header_title' => 'Bank Soal Pembelajaran & CBT',
            'questions' => $questions,
            'subjects' => $subjects,
            'classes' => $classes,
            'subjectId' => $subjectId,
            'classId' => $classId,
        ];

        return view('cbt.question_bank.list', $data);
    }

    public function questionBankAdd()
    {
        $data = [
            'header_title' => 'Tambah Butir Soal Baru',
            'subjects' => SubjectModel::where('is_delete', 0)->orderBy('name', 'asc')->get(),
            'classes' => ClassModel::where('is_delete', 0)->orderBy('name', 'asc')->get(),
        ];

        return view('cbt.question_bank.add', $data);
    }

    public function questionBankStore(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|integer',
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'option_e' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D,E',
            'marks' => 'required|numeric|min:1',
        ]);

        QuestionBankModel::create([
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
            'created_by' => Auth::id(),
            'question_text' => $request->question_text,
            'question_type' => 'mcq',
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'option_e' => $request->option_e,
            'correct_answer' => $request->correct_answer,
            'explanation' => $request->explanation,
            'marks' => $request->marks,
            'status' => 0,
            'is_delete' => 0,
        ]);

        return redirect('cbt/questions')->with('success', 'Soal berhasil ditambahkan ke Bank Soal Sekolah!');
    }

    public function questionBankDelete($id)
    {
        $question = QuestionBankModel::findOrFail($id);
        $question->is_delete = 1;
        $question->save();

        return redirect()->back()->with('success', 'Butir soal berhasil dihapus dari bank soal.');
    }

    // ==========================================
    // 2. KELOLA UJIAN / KUIS CBT (TEACHER & ADMIN)
    // ==========================================

    public function examList(Request $request)
    {
        $user = Auth::user();
        $query = CbtExamModel::with(['classModel', 'subject', 'teacher', 'examQuestions'])
            ->where('is_delete', 0)
            ->orderBy('id', 'desc');

        if ($user->user_type == 2) {
            // Teacher sees own exams or all in school
            $query->where('created_by', $user->id);
        }

        $exams = $query->get();

        $data = [
            'header_title' => 'Manajemen Ujian & Kuis CBT',
            'exams' => $exams,
        ];

        return view('cbt.exam.list', $data);
    }

    public function examAdd()
    {
        $classes = ClassModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        $subjects = SubjectModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        $questions = QuestionBankModel::where('is_delete', 0)->orderBy('id', 'desc')->get();

        $data = [
            'header_title' => 'Buat Jadwal & Paket Ujian CBT Baru',
            'classes' => $classes,
            'subjects' => $subjects,
            'questions' => $questions,
        ];

        return view('cbt.exam.add', $data);
    }

    public function examStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'duration_minutes' => 'required|integer|min:5|max:240',
            'passing_grade' => 'required|integer|min:0|max:100',
            'question_ids' => 'required|array|min:1',
        ]);

        $exam = CbtExamModel::create([
            'title' => $request->title,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'created_by' => Auth::id(),
            'duration_minutes' => $request->duration_minutes,
            'passing_grade' => $request->passing_grade,
            'instructions' => $request->instructions ?: 'Bacalah doa sebelum mengerjakan. Pilihlah satu jawaban yang paling tepat. Waktu pengerjaan berjalan otomatis.',
            'is_published' => 1,
            'is_delete' => 0,
        ]);

        $order = 1;
        foreach ($request->question_ids as $qId) {
            CbtExamQuestionModel::create([
                'cbt_exam_id' => $exam->id,
                'question_id' => $qId,
                'sort_order' => $order++,
            ]);
        }

        return redirect('cbt/exams')->with('success', 'Paket ujian CBT berhasil dibuat dan dipublikasikan!');
    }

    public function examResults($id)
    {
        $exam = CbtExamModel::with(['classModel', 'subject', 'teacher', 'examQuestions.question'])->findOrFail($id);
        $attempts = CbtStudentAttemptModel::with('student')
            ->where('cbt_exam_id', $id)
            ->where('status', 'submitted')
            ->orderBy('total_score', 'desc')
            ->get();

        $data = [
            'header_title' => 'Rekapitulasi Nilai & Hasil CBT: ' . $exam->title,
            'exam' => $exam,
            'attempts' => $attempts,
        ];

        return view('cbt.exam.results', $data);
    }

    // ==========================================
    // 3. RUANG UJIAN CBT SISWA (STUDENT CBT PLAYER)
    // ==========================================

    public function studentExamList()
    {
        $student = Auth::user();
        $classId = $student->class_id;

        $exams = CbtExamModel::with(['subject', 'teacher', 'examQuestions'])
            ->where('class_id', $classId)
            ->where('is_published', 1)
            ->where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->get();

        $myAttempts = CbtStudentAttemptModel::where('student_id', $student->id)
            ->get()
            ->keyBy('cbt_exam_id');

        $data = [
            'header_title' => 'Jadwal & Ruang Kuis CBT Saya',
            'exams' => $exams,
            'myAttempts' => $myAttempts,
        ];

        return view('cbt.student.list', $data);
    }

    public function studentExamStart($id)
    {
        $student = Auth::user();
        $exam = CbtExamModel::with(['subject', 'classModel', 'examQuestions.question'])
            ->where('id', $id)
            ->where('class_id', $student->class_id)
            ->where('is_published', 1)
            ->where('is_delete', 0)
            ->firstOrFail();

        // Check or create attempt
        $attempt = CbtStudentAttemptModel::where('cbt_exam_id', $id)
            ->where('student_id', $student->id)
            ->first();

        if ($attempt && $attempt->status == 'submitted') {
            return redirect('cbt/student/result/' . $attempt->id)->with('info', 'Anda telah menyelesaikan ujian ini.');
        }

        if (!$attempt) {
            $attempt = CbtStudentAttemptModel::create([
                'cbt_exam_id' => $id,
                'student_id' => $student->id,
                'started_at' => Carbon::now(),
                'status' => 'in_progress',
            ]);
        }

        // Calculate remaining seconds
        $startTime = Carbon::parse($attempt->started_at);
        $endTime = $startTime->copy()->addMinutes($exam->duration_minutes);
        $remainingSeconds = max(0, Carbon::now()->diffInSeconds($endTime, false));

        if ($remainingSeconds <= 0) {
            // Auto submit if expired
            return redirect('cbt/student/result/' . $attempt->id)->with('warning', 'Waktu pengerjaan telah habis.');
        }

        $questions = $exam->examQuestions->map(function ($eq) {
            return $eq->question;
        })->filter();

        $data = [
            'header_title' => 'Ruang Ujian CBT: ' . $exam->title,
            'exam' => $exam,
            'attempt' => $attempt,
            'questions' => $questions,
            'remainingSeconds' => $remainingSeconds,
        ];

        return view('cbt.student.player', $data);
    }

    public function studentExamSubmit(Request $request, $id)
    {
        $student = Auth::user();
        $exam = CbtExamModel::with('examQuestions.question')->findOrFail($id);
        $attempt = CbtStudentAttemptModel::where('cbt_exam_id', $id)
            ->where('student_id', $student->id)
            ->firstOrFail();

        if ($attempt->status == 'submitted') {
            return redirect('cbt/student/result/' . $attempt->id);
        }

        $submittedAnswers = $request->input('answers', []);
        $correctCount = 0;
        $wrongCount = 0;
        $totalQuestions = $exam->examQuestions->count();
        $totalEarnedMarks = 0;
        $maxPossibleMarks = 0;

        foreach ($exam->examQuestions as $eq) {
            $q = $eq->question;
            if (!$q) continue;

            $maxPossibleMarks += $q->marks;
            $studentAns = isset($submittedAnswers[$q->id]) ? strtoupper(trim($submittedAnswers[$q->id])) : null;
            $isCorrect = ($studentAns && $studentAns === strtoupper(trim($q->correct_answer))) ? 1 : 0;
            $scoreAwarded = $isCorrect ? $q->marks : 0;

            if ($isCorrect) {
                $correctCount++;
                $totalEarnedMarks += $scoreAwarded;
            } else {
                $wrongCount++;
            }

            // Save individual answer
            CbtStudentAnswerModel::create([
                'attempt_id' => $attempt->id,
                'question_id' => $q->id,
                'student_answer' => $studentAns,
                'is_correct' => $isCorrect,
                'score_awarded' => $scoreAwarded,
            ]);
        }

        // Calculate final score scaled to 100
        $finalScore = $maxPossibleMarks > 0 ? round(($totalEarnedMarks / $maxPossibleMarks) * 100, 2) : 0;

        $attempt->update([
            'submitted_at' => Carbon::now(),
            'total_score' => $finalScore,
            'correct_count' => $correctCount,
            'wrong_count' => $wrongCount,
            'status' => 'submitted',
        ]);

        return redirect('cbt/student/result/' . $attempt->id)->with('success', 'Ujian CBT berhasil diselesaikan! Skor Anda telah dihitung otomatis.');
    }

    public function studentExamResult($attemptId)
    {
        $attempt = CbtStudentAttemptModel::with(['exam.subject', 'exam.classModel', 'answers.question'])
            ->findOrFail($attemptId);

        // Security check
        if (Auth::user()->user_type == 3 && $attempt->student_id != Auth::id()) {
            abort(403);
        }

        $data = [
            'header_title' => 'Hasil Ujian CBT: ' . $attempt->exam->title,
            'attempt' => $attempt,
            'exam' => $attempt->exam,
        ];

        return view('cbt.student.result', $data);
    }
}
