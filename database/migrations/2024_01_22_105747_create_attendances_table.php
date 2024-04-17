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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('finger_device_id');
            $table->string('uid');
            $table->unsignedBigInteger('emp_id');
            $table->integer('state');
            $table->time('attendance_time');
            $table->date('attendance_date');
            $table->integer('type');
            $table->integer('status')->default(1); // 1: Present, 0: Late
            $table->timestamps();

            $table->foreign('finger_device_id')->references('id')->on('finger_devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
