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
        // 1. Notice Board / Announcements Table (PRD Section 12)
        Schema::create('notice_board', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('notice_date');
            $table->date('publish_date')->nullable();
            $table->text('message');
            $table->string('message_to')->default('all'); // 'all', 'teacher', 'student', 'parent'
            $table->unsignedBigInteger('target_class_id')->nullable(); // null for all classes, or specific class_id
            $table->unsignedBigInteger('created_by_id');
            $table->string('priority')->default('normal'); // 'normal', 'urgent', 'info'
            $table->tinyInteger('status')->default(0); // 0: Terbit, 1: Draf/Arsip
            $table->timestamps();

            $table->index('notice_date');
            $table->index('message_to');
            $table->index('target_class_id');
        });

        // 2. Student Guidance & Pastoral Notes Table (PRD Section 6: Fitur Wali Kelas)
        Schema::create('student_guidances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('homeroom_teacher_id');
            $table->unsignedBigInteger('class_id');
            $table->string('category')->default('Akademik'); // Akademik, Karakter, Prestasi, Kedisiplinan
            $table->date('date');
            $table->string('title');
            $table->text('description');
            $table->text('action_taken')->nullable(); // Tindak lanjut wali kelas
            $table->string('follow_up_status')->default('Selesai'); // 'Selesai', 'Dalam Pemantauan', 'Rujukan BK'
            $table->timestamps();

            $table->index('student_id');
            $table->index('class_id');
            $table->index('homeroom_teacher_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_guidances');
        Schema::dropIfExists('notice_board');
    }
};
