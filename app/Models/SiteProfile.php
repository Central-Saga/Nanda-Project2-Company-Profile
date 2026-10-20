<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteProfile extends Model
{
    protected $table = 'site_profile';

    public $timestamps = false;

    protected $fillable = [
        'company_name',
        'tagline',
        'hero_title',
        'hero_subtitle',
        'about_story',
        'vision',
        'mission',
        'core_values',
        'stats',
        'hero_image',
        'operating_hours',
        'phone',
        'whatsapp_number',
        'whatsapp_template',
        'email',
        'address',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'maps_url',
        'seo_keywords',
        'favicon',
        'updated_at',
    ];

    protected $casts = [
        'core_values' => 'array',
        'stats' => 'array',
        'updated_at' => 'datetime',
    ];

    public static function current(): ?self
    {
        return static::first();
    }
}
