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
        Schema::create('attendance_lists', function (Blueprint $table) {
            $table->id(); 
            $table->string('code_al');
            $table->foreignId('lecturer_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_class_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('has_finished')->default(1); //jika perulangan id selesai has_finished=1 
            $table->dateTime('date_finished')->nullable();
            $table->tinyInteger('has_acc_kajur')->default(1);
            $table->dateTime('date_acc_kajur')->nullable();
            $table->foreignId('lecturer_kajur_id')->nullable()->constrained('lecturers')->onDelete('cascade');
            $table->foreignId('d')->nullable()->constrained('periodes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_lists');
    }
};
