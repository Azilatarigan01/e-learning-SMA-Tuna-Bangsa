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
        if (!Schema::hasTable('learning_materials')) {
            Schema::create('learning_materials', function (Blueprint $table) {
                $table->id();
                $table->integer('class_id');
                $table->integer('subject_id');
                $table->integer('created_by'); // ID Guru / Pengunggah
                $table->string('title');
                $table->string('meeting_number')->default('Pertemuan 1'); // misal: "Pertemuan 1", "Bab 1"
                $table->text('description')->nullable();
                $table->string('document_file')->nullable();
                $table->string('video_url')->nullable();
                $table->tinyInteger('is_published')->default(1)->comment('1: Diterbitkan, 0: Draft');
                $table->tinyInteger('is_delete')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_materials');
    }
};
