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
        // 1. Pivot Table Parent to Students (PRD Section 3 & 11)
        Schema::create('parent_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('student_id');
            $table->string('relationship')->default('Orang Tua'); // Ayah, Ibu, Wali
            $table->timestamps();

            $table->unique(['parent_id', 'student_id']);
            $table->index('parent_id');
            $table->index('student_id');
        });

        // 2. Class Discussion Forum Threads (PRD Section 4 & 15)
        Schema::create('class_discussions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('user_id'); // Author (Teacher or Student)
            $table->string('title');
            $table->text('content');
            $table->tinyInteger('is_pinned')->default(0); // 1: Pinned by Teacher
            $table->tinyInteger('status')->default(0); // 0: Aktif, 1: Ditutup
            $table->timestamps();

            $table->index(['class_id', 'subject_id']);
            $table->index('user_id');
        });

        // 3. Discussion Replies
        Schema::create('class_discussion_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discussion_id');
            $table->unsignedBigInteger('user_id'); // Author
            $table->text('reply_text');
            $table->timestamps();

            $table->index('discussion_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_discussion_replies');
        Schema::dropIfExists('class_discussions');
        Schema::dropIfExists('parent_students');
    }
};
