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
        Schema::create('class_timetables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academic_year_id')->default(1);
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('room_id');
            $table->string('day_of_week'); // Senin, Selasa, Rabu, Kamis, Jumat, Sabtu
            $table->time('start_time');
            $table->time('end_time');
            $table->tinyInteger('status')->default(0); // 0: Aktif, 1: Dibatalkan
            $table->timestamps();

            // Indexes for fast schedule and anti-conflict queries
            $table->index(['class_id', 'day_of_week']);
            $table->index(['teacher_id', 'day_of_week']);
            $table->index(['room_id', 'day_of_week']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_timetables');
    }
};
