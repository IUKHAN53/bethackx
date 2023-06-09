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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('game_text')->nullable();
            $table->string('game_type')->default('slots');
            $table->string('description')->nullable();
            $table->string('iframe_link')->nullable();
            $table->string('image')->nullable();
            $table->string('banner')->nullable();
            $table->smallInteger('status')->default(1);
            $table->unsignedBigInteger('company_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
