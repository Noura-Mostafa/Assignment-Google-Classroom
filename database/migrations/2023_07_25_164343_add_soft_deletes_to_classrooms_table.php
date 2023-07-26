<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('classrooms', function (Blueprint $table) {
             $table->softDeletes()->after('status');
             $table->enum('status' , ['active' , 'archived' , 'deleted'])->change();
        });
    }

    
    public function down(): void
    {
        Schema::table('classrooms', function (Blueprint $table) {
             $table->dropSoftDeletes();
             $table->enum('status' , ['active' , 'archived'])->change();

        });
    }
};
