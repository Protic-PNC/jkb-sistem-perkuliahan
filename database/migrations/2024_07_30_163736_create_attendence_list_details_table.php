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
        Schema::create('attendance_list_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_list_id')->constrained()->onDelete('cascade');
            $table->integer('meeting_order'); 
            $table->tinyInteger('course_status')->comment('1=sesuai jadwal, 2= pertukaran, 3= pengganti, 4= tambahan');
            $table->integer('start_hour')->nullable(); //jam pertemuan 1 
            $table->integer('end_hour')->nullable(); //jam pertemuan 2 
            $table->string('meeting_hour')->nullable(); //opsional, 1 sd 2
            $table->integer('sum_attendance_students')->nullable(); //jumlah kehadiran
            $table->boolean('has_acc_student')->default(0);
            $table->boolean('has_acc_lecturer')->default(0);
            $table->string('signature_student')->nullable();
            $table->string('signature_lecturer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_list_details');
    }
};
