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
        Schema::create('site_profile', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 150);
            $table->string('tagline', 255);
            $table->string('hero_title', 255);
            $table->string('hero_subtitle', 500)->nullable();
            $table->string('hero_image', 255)->nullable();
            $table->string('operating_hours', 255)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('address')->nullable();
            $table->string('facebook_url', 255)->nullable();
            $table->string('instagram_url', 255)->nullable();
            $table->string('linkedin_url', 255)->nullable();
            $table->string('maps_url', 255)->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_profile');
    }
};

