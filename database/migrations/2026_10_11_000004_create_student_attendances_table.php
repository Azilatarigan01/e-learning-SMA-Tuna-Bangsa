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
        if (!Schema::hasTable('student_attendances')) {
            Schema::create('student_attendances', function (Blueprint $table) {
                $table->id();
                $table->integer('class_id');
                $table->integer('subject_id');
                $table->integer('teacher_id');
                $table->integer('student_id');
                $table->date('attendance_date');
                $table->string('meeting_number')->default('Pertemuan 1');
                $table->tinyInteger('attendance_status')->comment('1: Hadir, 2: Sakit, 3: Izin, 4: Alpa');
                $table->string('notes')->nullable();
                $table->timestamps();

                $table->index(['class_id', 'subject_id', 'attendance_date']);
                $table->index('student_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendances');
    }
};
