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
        Schema::create('hero_poder', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hero_id');
            $table->unsignedBigInteger('poder_id');
            $table->foreign('hero_id')->references('id')->on('heroes');
            $table->foreign('poder_id')->references('id')->on('poderes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_poder');
    }
};
