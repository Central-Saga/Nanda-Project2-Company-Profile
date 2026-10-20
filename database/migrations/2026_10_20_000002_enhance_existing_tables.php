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
        // 1. Enhance services table
        Schema::table('services', function (Blueprint $table) {
            $table->string('icon', 100)->nullable()->after('slug');
            $table->json('benefits')->nullable()->after('description');
            $table->json('tech_stack')->nullable()->after('benefits');
            $table->boolean('is_featured')->default(false)->after('is_active');
        });

        // 2. Enhance articles table
        Schema::table('articles', function (Blueprint $table) {
            $table->string('category', 100)->default('Teknologi')->after('slug');
            $table->json('tags')->nullable()->after('category');
            $table->unsignedSmallInteger('reading_time')->default(4)->after('tags');
            $table->string('seo_title', 255)->nullable()->after('cover_image');
            $table->string('seo_description', 500)->nullable()->after('seo_title');
        });

        // 3. Enhance contact_messages table for mini CRM
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('company_name', 150)->nullable()->after('email');
            $table->string('service_type', 100)->nullable()->after('phone');
            $table->string('budget_range', 100)->nullable()->after('service_type');
            $table->string('crm_status', 50)->default('new')->after('status');
        });

        // 4. Enhance site_profile table
        Schema::table('site_profile', function (Blueprint $table) {
            $table->text('about_story')->nullable()->after('hero_subtitle');
            $table->text('vision')->nullable()->after('about_story');
            $table->text('mission')->nullable()->after('vision');
            $table->json('core_values')->nullable()->after('mission');
            $table->json('stats')->nullable()->after('core_values');
            $table->string('whatsapp_number', 50)->nullable()->after('phone');
            $table->text('whatsapp_template')->nullable()->after('whatsapp_number');
            $table->string('seo_keywords', 500)->nullable()->after('maps_url');
            $table->string('favicon', 255)->nullable()->after('seo_keywords');
        });

        // 5. Enhance users table for roles & active state
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 50)->default('admin')->after('password');
            $table->boolean('is_active')->default(true)->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['icon', 'benefits', 'tech_stack', 'is_featured']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['category', 'tags', 'reading_time', 'seo_title', 'seo_description']);
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn(['company_name', 'service_type', 'budget_range', 'crm_status']);
        });

        Schema::table('site_profile', function (Blueprint $table) {
            $table->dropColumn([
                'about_story', 'vision', 'mission', 'core_values', 'stats',
                'whatsapp_number', 'whatsapp_template', 'seo_keywords', 'favicon'
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'is_active']);
        });
    }
};
