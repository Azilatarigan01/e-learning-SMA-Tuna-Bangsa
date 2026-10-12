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
        // 1. In-App Notifications Table (PRD Section 12)
        if (!Schema::hasTable('in_app_notifications')) {
            Schema::create('in_app_notifications', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id'); // Recipient
                $table->integer('sender_id')->nullable();
                $table->string('title');
                $table->text('message');
                $table->string('url')->nullable();
                $table->string('type', 30)->default('info'); // 'info', 'assignment', 'exam', 'schedule', 'announcement', 'grade'
                $table->tinyInteger('is_read')->default(0); // 0: Unread, 1: Read
                $table->timestamps();
            });
        }

        // 2. Activity Logs / Audit Trail Table (PRD Section 8 & 14)
        if (!Schema::hasTable('activity_logs')) {
            Schema::create('activity_logs', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->string('module', 50); // 'Nilai & Asesmen', 'Presensi', 'Jadwal', 'CBT Exam', 'Pengumuman', 'Pengguna'
                $table->string('action', 30); // 'Create', 'Update', 'Delete', 'Publish', 'Login'
                $table->text('description');
                $table->string('ip_address', 45)->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('in_app_notifications');
    }
};
