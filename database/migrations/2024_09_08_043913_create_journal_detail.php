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
            $table->integer('meeting_order'); 
            $table->tinyInteger('course_status')->comment('1=sesuai jadwal, 2= pertukaran, 3= pengganti, 4= tambahan'); 
            $table->string('material_course'); 
            $table->string('learning_methods')->comment('offline/online');
            $table->integer('sum_attendance_students')->nullable(); 
            $table->boolean('has_acc_student')->default(0);
            $table->boolean('has_acc_lecturer')->default(0);
            $table->string('signature_student')->nullable();
            $table->string('signature_lecturer')->nullable();
            $table->string('signature_kaprodi')->nullable();
            $table->string('signature_kajur')->nullable();
            $table->date('date_signature_kaprodi')->nullable();
            $table->date('date_signature_kajur')->nullable();
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
