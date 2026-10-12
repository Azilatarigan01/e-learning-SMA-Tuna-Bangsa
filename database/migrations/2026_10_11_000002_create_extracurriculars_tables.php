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
        if (!Schema::hasTable('extracurriculars')) {
            Schema::create('extracurriculars', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('category')->default('Umum'); // Olahraga, Sains & Teknologi, Seni & Budaya, Kepemimpinan
                $table->unsignedBigInteger('teacher_id')->nullable(); // Guru Pembina
                $table->string('day_of_week')->nullable(); // misal: Jumat, Sabtu
                $table->string('start_time')->nullable(); // misal: 15:30
                $table->string('end_time')->nullable(); // misal: 17:30
                $table->string('location')->nullable(); // misal: Lapangan Olahraga Utama
                $table->integer('quota')->default(35);
                $table->tinyInteger('status')->default(0)->comment('0: Aktif, 1: Nonaktif');
                $table->text('description')->nullable();
                $table->string('icon')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('extracurricular_members')) {
            Schema::create('extracurricular_members', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('extracurricular_id');
                $table->unsignedBigInteger('student_id');
                $table->string('role')->default('Anggota'); // Ketua, Wakil Ketua, Sekretaris, Bendahara, Anggota
                $table->tinyInteger('status')->default(0)->comment('0: Aktif/Disetujui, 1: Pending, 2: Ditolak');
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extracurricular_members');
        Schema::dropIfExists('extracurriculars');
    }
};
