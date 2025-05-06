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
        Schema::create('journal_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_id')->constrained()->onDelete('cascade');
            $table->foreignId('attendance_list_detail_id')->constrained('attendance_list_details')->onDelete('cascade');
            $table->string('material_course')->nullable();
            $table->string('learning_methods')->nullable();
            $table->tinyInteger('has_acc_student')->default(1);
            $table->tinyInteger('has_acc_lecturer')->default(1);
            $table->tinyInteger('has_acc_kaprodi')->default(1);
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('cascade');
            $table->foreignId('lecturer_kaprodi_id')->nullable()->constrained('lecturers')->onDelete('cascade');
            $table->dateTime('date_acc_student')->nullable();
            $table->dateTime('date_acc_lecturer')->nullable();
            $table->dateTime('date_acc_kaprodi')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_details');
    }
};
