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
            $table->id();
            $table->foreignId('attendance_list_id')->constrained('attendance_lists')->onDelete('cascade');
            $table->tinyInteger('has_finished')->default(1); //jika perulangan id selesai has_finished=3 
            $table->tinyInteger('has_acc_kajur')->default(1);
            $table->foreignId('lecturer_kajur_id')->nullable()->constrained('lecturers')->onDelete('cascade');
            $table->dateTime('date_finished')->nullable();
            $table->dateTime('date_acc_kajur')->nullable();
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
