<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGradeModel extends Model
{
    use HasFactory;

    protected $table = 'student_grades';

    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id',
        'student_id',
        'academic_year_id',
        'homework_score',
        'quiz_score',
        'midterm_score',
        'final_exam_score',
        'final_score',
        'grade_letter',
        'passing_status',
        'competency_notes',
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

    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }

    public function getAssignmentScoreAttribute()
    {
        return $this->homework_score ?? 0;
    }

    public function getGradeTotalAttribute()
    {
        return $this->final_score ?? 0;
    }

    public function getLetterGradeAttribute()
    {
        return $this->grade_letter ?? '-';
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYearModel::class, 'academic_year_id');
    }

    public static function computeFinalScore($hw, $quiz, $midterm, $finalExam)
    {
        $hw = (float) $hw;
        $quiz = (float) $quiz;
        $midterm = (float) $midterm;
        $finalExam = (float) $finalExam;

        // Bobot: 20% Tugas, 20% Kuis/Formatif, 30% UTS, 30% UAS
        $final = ($hw * 0.20) + ($quiz * 0.20) + ($midterm * 0.30) + ($finalExam * 0.30);
        return round($final, 2);
    }

    public static function computeGradeLetter($score)
    {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        if ($score >= 75) return 'C';
        return 'D';
    }

    public static function computePassingStatus($score)
    {
        return $score >= 75 ? 1 : 0;
    }

    public static function getGradesByClassSubject($class_id, $subject_id)
    {
        return self::where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->get()
            ->keyBy('student_id');
    }

    public static function getStudentReportCard($student_id)
    {
        return self::where('student_id', $student_id)
            ->with(['subjectModel', 'teacher'])
            ->orderBy('id', 'asc')
            ->get();
    }

    public static function getAdminLegerReport($class_id = null, $subject_id = null)
    {
        $query = self::with(['student', 'classModel', 'subjectModel', 'teacher'])
            ->orderBy('id', 'desc');

        if (!empty($class_id)) {
            $query->where('class_id', $class_id);
        }
        if (!empty($subject_id)) {
            $query->where('subject_id', $subject_id);
        }

        return $query->get();
    }

    public static function getStudentGPA($student_id)
    {
        $grades = self::where('student_id', $student_id)->get();
        if ($grades->isEmpty()) {
            return ['gpa' => '0.00', 'average' => '0.0'];
        }

        $totalPoints = 0;
        $totalScores = 0;
        foreach ($grades as $g) {
            $totalScores += (float) ($g->final_score ?: 0);
            $letter = strtoupper($g->grade_letter ?: 'D');
            $pts = 1.0;
            if ($letter === 'A') $pts = 4.0;
            elseif ($letter === 'B') $pts = 3.0;
            elseif ($letter === 'C') $pts = 2.0;
            $totalPoints += $pts;
        }

        $count = $grades->count();
        $gpa = round($totalPoints / $count, 2);
        $avg = round($totalScores / $count, 1);

        return [
            'gpa' => number_format($gpa, 2),
            'average' => number_format($avg, 1),
        ];
    }
}
