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
        // 1. Question Bank Table
        if (!Schema::hasTable('question_banks')) {
            Schema::create('question_banks', function (Blueprint $table) {
                $table->id();
                $table->integer('subject_id');
                $table->integer('class_id')->nullable();
                $table->integer('created_by'); // Teacher / Admin ID
                $table->text('question_text');
                $table->string('question_type')->default('mcq'); // 'mcq' or 'essay'
                $table->text('option_a')->nullable();
                $table->text('option_b')->nullable();
                $table->text('option_c')->nullable();
                $table->text('option_d')->nullable();
                $table->text('option_e')->nullable();
                $table->string('correct_answer', 10)->nullable(); // 'A', 'B', 'C', 'D', 'E'
                $table->text('explanation')->nullable();
                $table->integer('marks')->default(10);
                $table->tinyInteger('status')->default(0); // 0: Active, 1: Inactive
                $table->tinyInteger('is_delete')->default(0);
                $table->timestamps();
            });
        }

        // 2. CBT Exams / Quizzes Table
        if (!Schema::hasTable('cbt_exams')) {
            Schema::create('cbt_exams', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->integer('class_id');
                $table->integer('subject_id');
                $table->integer('created_by');
                $table->integer('duration_minutes')->default(60); // minutes
                $table->dateTime('start_time')->nullable();
                $table->dateTime('end_time')->nullable();
                $table->integer('passing_grade')->default(75); // KKM
                $table->text('instructions')->nullable();
                $table->tinyInteger('is_published')->default(1);
                $table->tinyInteger('is_delete')->default(0);
                $table->timestamps();
            });
        }

        // 3. CBT Exam Question Mapping
        if (!Schema::hasTable('cbt_exam_questions')) {
            Schema::create('cbt_exam_questions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('cbt_exam_id');
                $table->unsignedBigInteger('question_id');
                $table->integer('sort_order')->default(1);
                $table->timestamps();
            });
        }

        // 4. Student CBT Attempts
        if (!Schema::hasTable('cbt_student_attempts')) {
            Schema::create('cbt_student_attempts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('cbt_exam_id');
                $table->integer('student_id');
                $table->dateTime('started_at');
                $table->dateTime('submitted_at')->nullable();
                $table->decimal('total_score', 5, 2)->default(0);
                $table->integer('correct_count')->default(0);
                $table->integer('wrong_count')->default(0);
                $table->string('status', 20)->default('in_progress'); // 'in_progress', 'submitted', 'graded'
                $table->timestamps();
            });
        }

        // 5. Student Answers Detail
        if (!Schema::hasTable('cbt_student_answers')) {
            Schema::create('cbt_student_answers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('attempt_id');
                $table->unsignedBigInteger('question_id');
                $table->string('student_answer', 10)->nullable();
                $table->tinyInteger('is_correct')->default(0);
                $table->decimal('score_awarded', 5, 2)->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cbt_student_answers');
        Schema::dropIfExists('cbt_student_attempts');
        Schema::dropIfExists('cbt_exam_questions');
        Schema::dropIfExists('cbt_exams');
        Schema::dropIfExists('question_banks');
    }
};
