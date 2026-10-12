<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('user_type')->default(2)->comment('1:admin, 2:teacher, 3:student');
            $table->string('admission_number')->nullable();
            $table->string('roll_number')->nullable();
            $table->integer('class_id')->nullable();
            $table->string('gender', 50)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('religion', 50)->nullable();
            $table->string('mobile_number', 15)->nullable();
            $table->date('admission_date')->nullable();
            $table->tinyInteger('marital_status')->default(0)->comment('0:single, 1:married');
            $table->text('address')->nullable();
            $table->string('profile_pic', 100)->nullable();
            $table->tinyInteger('is_delete')->default(0)->comment('0:not deleted, 1:deleted');
            $table->tinyInteger('status')->default(0)->comment('0:active, 1:inactive');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
