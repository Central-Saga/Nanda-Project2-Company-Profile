<?php

namespace Database\Seeders;

use App\Models\SiteProfile;
use Illuminate\Database\Seeder;

class SiteProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (SiteProfile::exists()) {
            return;
        }

        SiteProfile::create([
            'company_name' => 'PT. Central Saga Mandala',
            'tagline' => 'Software House & Creative Agency',
            'hero_title' => 'Membangun Impian Digital, Dari Bali ke Dunia',
            'hero_subtitle' => null,
            'hero_image' => null,
            'operating_hours' => null,
            'phone' => null,
            'email' => null,
            'address' => 'Tabanan, Bali, Indonesia',
            'facebook_url' => null,
            'instagram_url' => null,
            'linkedin_url' => null,
            'maps_url' => null,
        ]);
    }
}

