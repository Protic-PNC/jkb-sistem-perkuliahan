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
            $table->string('material');
            $table->boolean('has_acc_student');
            $table->boolean('has_acc_lecturer');
            $table->foreignId('attendence_list_detail_id')->constrained()->onDelete('cascade'); //untuk ambil jumlah hadir->count()
            $table->foreignId('journal_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
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
