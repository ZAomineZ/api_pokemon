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
        Schema::create('ability_pokemon', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pokemon_id')->constrained('pokemons')
                ->onDelete('cascade'); // Référence vers la table pokemons
            $table->foreignId('ability_id')->constrained('abilities')
                ->onDelete('cascade'); // Référence vers la table moves
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ability_pokemon');
    }
};
