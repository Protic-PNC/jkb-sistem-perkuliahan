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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('type');//praktek/teori
            $table->string('name');
            $table->integer('sks'); //1 sks = 8pertemuan
            $table->integer('hours'); //2 jam
            $table->float('meeting')->nullable(); //pertemuan(meeting) diisi $meeting = banyak sks * 8 pertemuan
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
