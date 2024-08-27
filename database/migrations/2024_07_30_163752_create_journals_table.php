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
        Schema::create('journals', function (Blueprint $table) {
            $table->id(); //id = foreach sebanyak sks x pertemuan dalam semester, //jika id pertemuan <= banyak pertemuan belum selesai pending, ==  menunggu persetujuan wait, klo disetujui==finished dibagian has_finished
            $table->foreignId('attendence_list_id')->constrained()->onDelete('cascade');
            $table->string('has_finished'); //
            $table->boolean('has_acc_head_departement');
            $table->foreignId('course_lecturer_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_class_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_class_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
