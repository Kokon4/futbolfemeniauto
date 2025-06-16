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
            $table->foreignId('equip_principal_id')->nullable()->constrained('equips')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estadis', function (Blueprint $table) {
            $table->dropForeign(['equip_principal_id']);
            $table->dropColumn('equip_principal_id');
        });
    }
};
