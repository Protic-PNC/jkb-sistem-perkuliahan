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
        //pivot
        Schema::create('attendence_list_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendence_list_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('attendence_student'); //alfa/hadir
            $table->string('course_status');
            $table->boolean('has_acc_student');
            $table->boolean('has_acc_lecturer');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendence_list_details');
    }
};
