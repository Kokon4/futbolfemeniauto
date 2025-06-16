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
        Schema::table('partits', function (Blueprint $table) {
           
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partits', function (Blueprint $table) {
            $table->dropForeign(['equip_local_id']);
            $table->dropForeign(['equip_visitant_id']);
            $table->dropColumn(['equip_local_id', 'equip_visitant_id', 'data', 'resultat']);
        });
    }
};
