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
        Schema::create('typeables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pokemon_id')
                ->constrained('pokemons')->onDelete('cascade');
            $table->foreignId('type_id')
                ->constrained('types')->onDelete('cascade');
            $table->unsignedBigInteger('typeable_id'); // L'ID polymorphique (ex. Type ou autre)
            $table->string('typeable_type'); // Le type polymorphique (le nom du modèle, ex. App\Models\Type)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('typeables');
    }
};
