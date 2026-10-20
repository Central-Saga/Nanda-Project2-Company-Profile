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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('slug', 220)->unique();
            $table->string('category', 100)->default('Web Platform');
            $table->string('client', 150)->nullable();
            $table->string('completion_date', 50)->nullable();
            $table->string('external_url', 255)->nullable();
            $table->text('description');
            $table->longText('content')->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->json('images')->nullable();
            $table->json('tech_stack')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_published', 'is_featured', 'sort_order']);
            $table->index('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
