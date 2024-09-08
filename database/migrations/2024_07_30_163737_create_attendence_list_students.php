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
        Schema::create('attendance_list_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_list_detail_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('attendence_student'); //alfa/hadir
            $table->integer('minutes_late')->nullable(); //jika terlambat
            $table->string('note')->nullable(); //jika terlambat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendence_list_students');
    }
};
