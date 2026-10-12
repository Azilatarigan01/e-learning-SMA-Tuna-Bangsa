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
        if (!Schema::hasTable('academic_years')) {
            Schema::create('academic_years', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // e.g. "2026/2027"
                $table->enum('semester', ['Ganjil', 'Genap'])->default('Ganjil');
                $table->tinyInteger('is_active')->default(0)->comment('1: Aktif, 0: Nonaktif');
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('rooms')) {
            Schema::create('rooms', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // e.g. "Ruang Kelas X-A", "Lab Komputer 1"
                $table->string('type')->default('Kelas Teori'); // e.g. Kelas Teori, Laboratorium, Lapangan, Aula
                $table->integer('capacity')->default(36);
                $table->tinyInteger('status')->default(0)->comment('0: Tersedia, 1: Dalam Perbaikan');
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
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('academic_years');
    }
};
