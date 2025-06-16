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
        Schema::create('partits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equip_local_id')->constrained('equips'); 
            $table->foreignId('equip_visitant_id')->constrained('equips');  
            $table->foreignId('estadi_id')->constrained('estadis');
            $table->foreignId('arbitre_id')->constrained('users');
            $table->dateTime('data'); 
            $table->string('resultat')->nullable();
            $table->integer('jornada');
            $table->integer('gol_local')->nullable();
            $table->integer('gol_visitant')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partits');
    }
};
