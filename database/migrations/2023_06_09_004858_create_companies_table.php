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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->string('tertiary_color')->nullable();
            $table->string('buttons_color')->nullable();
            $table->string('notices_color')->nullable();
            $table->string('request_access_link')->nullable();
            $table->string('help_link')->nullable();
            $table->string('home_banner')->nullable();
            $table->string('home_banner_ref_link')->nullable();
            $table->string('admin_tutorial_link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->smallInteger('is_default')->default(0);
            $table->unsignedBigInteger('admin_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
