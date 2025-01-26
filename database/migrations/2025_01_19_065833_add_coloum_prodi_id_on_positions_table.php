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
        Schema::table('positions', function (Blueprint $table) {  
            $table->foreignId('prodi_id')->nullable()->constrained('study_programs')->onDelete('cascade')->after('name');
        });  
    }  
  
    public function down()  
    {  
        Schema::table('your_table_name', function (Blueprint $table) {  
            $table->dropForeign(['prodi_id']); 
            $table->dropColumn('prodi_id'); 
        });  
    }  
};
