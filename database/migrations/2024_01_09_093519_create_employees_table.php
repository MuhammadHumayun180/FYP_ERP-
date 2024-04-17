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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('national_id')->unique()->nullable();
            $table->string('social_security_number')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->unique();
            $table->text('address')->nullable();
            $table->string('employee_id')->unique();
            $table->string('position');
            $table->string('department');
            $table->date('date_of_hire');
            $table->string('employment_type')->nullable();
            $table->decimal('basic_salary', 10, 2)->default(0); // New field for basic salary
            $table->string('office_timing')->default('09:00:00'); // New field for office timing
            $table->string('employment_status')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
