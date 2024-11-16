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
        Schema::create('moves', function (Blueprint $table) {
            $table->id();
            $table->string('name_fr')->unique();
            $table->string('name_en')->unique();
            $table->string('slug_en')->unique();
            $table->string('slug_fr')->unique();
            $table->integer('accuracy');
            $table->integer('power');
            $table->integer('pp');
            $table->longText('content_en');
            $table->text('short_content_en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moves');
    }
};
