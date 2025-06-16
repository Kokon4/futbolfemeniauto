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
        Schema::table('equips', function (Blueprint $table) {
    
            $table->foreignId('estadi_id')->nullable()->constrained()->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equips', function (Blueprint $table) {
        $table->string('estadi');
        $table->dropForeign(['estadi_id']);
        $table->dropColumn('estadi_id');
        });
    }
};
