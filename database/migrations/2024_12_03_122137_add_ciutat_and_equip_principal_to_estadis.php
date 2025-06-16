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
        Schema::table('estadis', function (Blueprint $table) {
            $table->string('ciutat')->nullable(); // Añade la columna ciutat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estadis', function (Blueprint $table) {
           $table->dropColumn('ciutat');
        });
    }
};
