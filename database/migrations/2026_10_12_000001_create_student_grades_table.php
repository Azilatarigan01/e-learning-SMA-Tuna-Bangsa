<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('student_grades')) {
            Schema::create('student_grades', function (Blueprint $table) {
                $table->id();
                $table->integer('class_id');
                $table->integer('subject_id');
                $table->integer('teacher_id');
                $table->integer('student_id');
                $table->integer('academic_year_id')->nullable();
                $table->decimal('homework_score', 5, 2)->default(0); // Nilai Tugas (20%)
                $table->decimal('quiz_score', 5, 2)->default(0);     // Nilai Kuis / Formatif (20%)
                $table->decimal('midterm_score', 5, 2)->default(0);  // Nilai UTS (30%)
                $table->decimal('final_exam_score', 5, 2)->default(0); // Nilai UAS (30%)
                $table->decimal('final_score', 5, 2)->default(0);    // Nilai Akhir Rapor (0-100)
                $table->string('grade_letter', 2)->default('C');     // A, B, C, D
                $table->tinyInteger('passing_status')->default(1)->comment('1: Tuntas (>= 75), 0: Belum Tuntas');
                $table->text('competency_notes')->nullable();         // Catatan Capaian Kompetensi
                $table->timestamps();

                $table->unique(['class_id', 'subject_id', 'student_id']);
                $table->index('student_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_grades');
    }
};
