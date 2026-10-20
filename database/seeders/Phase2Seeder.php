<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\AdminNotification;
use App\Models\Article;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Phase2Seeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        // 1. Ensure user has role super_admin
        if ($admin) {
            $admin->update([
                'role' => 'super_admin',
                'is_active' => true,
            ]);
        }

        // 2. Enhance SiteProfile with comprehensive company data
        $profile = SiteProfile::first();
        if ($profile) {
            $profile->update([
                'whatsapp_number' => '+6281234567890',
                'whatsapp_template' => 'Halo Central Saga, saya ingin berdiskusi mengenai proyek digital untuk bisnis saya.',
                'about_story' => 'Didirikan di Tabanan, Bali, PT. Central Saga Mandala berfokus pada penyediaan solusi perangkat lunak arsitektur tingkat tinggi dan desain antarmuka digital yang berkarakter. Kami menghubungkan kreativitas pulau Bali dengan disiplin rekayasa teknologi berstandar internasional.',
                'vision' => 'Menjadi studio rekayasa teknologi dan desain digital terkemuka yang dipercaya oleh industri nasional dan global melalui karya yang berdampak nyata.',
                'mission' => "1. Mengembangkan produk perangkat lunak yang aman, berkinerja tinggi, dan terukur.\n2. Merancang pengalaman antarmuka digital yang intuitif dan berpusat pada kenyamanan manusia.\n3. Memberikan transparansi proses kerja dan kepastian hasil dalam setiap kemitraan.",
                'core_values' => [
                    ['title' => 'Presisi Rekayasa', 'desc' => 'Setiap baris kode diuji dan dirancang menggunakan standar clean architecture.'],
                    ['title' => 'Kejelasan Fungsional', 'desc' => 'Desain visual yang bermakna, menghindari elemen dekorasi tanpa fungsi.'],
                    ['title' => 'Integritas & Kepercayaan', 'desc' => 'Keterbukaan proses dan kepastian komitmen waktu pengerjaan.'],
                ],
                'stats' => [
                    'projects_completed' => '45+',
                    'years_experience' => '6+',
                    'client_satisfaction' => '99%',
                    'core_engineers' => '12',
                ],
            ]);
        }

        // 3. Seed 4 Comprehensive Projects
        $projects = [
            [
                'title' => 'Artisan Bali Luxury Booking Engine',
                'category' => 'Web Platform',
                'client' => 'Artisan Bali Hospitality',
                'completion_date' => '2026',
                'external_url' => 'https://example.com/artisan-bali',
                'description' => 'Platform reservasi langsung dan manajemen inventaris kamar mewah terintegrasi payment gateway internasional dengan performa ultra cepat.',
                'content' => "Platform ini dibangun untuk menjawab tantangan fragmentasi pemesanan kamar villa independen di Bali. Kami merancang arsitektur sistem nir-jeda dengan sistem caching berbasis Redis dan antarmuka pemesanan multi-bahasa.\n\nHasilnya, tingkat konversi pemesanan langsung klien melonjak hingga 42% dalam 3 bulan pertama setelah peluncuran, mengeliminasi ketergantungan pada agregator pihak ketiga.",
                'tech_stack' => ['Laravel 12', 'Vue.js 3', 'Tailwind CSS', 'PostgreSQL', 'Redis'],
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'SagaPay Mobile FinTech Wallet',
                'category' => 'Mobile Application',
                'client' => 'Saga Finansial Nusantara',
                'completion_date' => '2026',
                'external_url' => 'https://example.com/sagapay',
                'description' => 'Aplikasi dompet digital berbasis Flutter dengan autentikasi biometrik, enkripsi end-to-end, dan pemindaian QRIS instan.',
                'content' => "SagaPay dirancang dengan fokus utama pada keandalan transaksi keuangan mikro dan kemudahan navigasi bagi pengguna segala usia. Dilengkapi integrasi API perbankan langsung dan pelaporan mutasi kas secara real-time.",
                'tech_stack' => ['Flutter', 'Dart', 'Golang Microservices', 'MySQL', 'Docker'],
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Nusantara Supply Chain ERP',
                'category' => 'Cloud Solutions',
                'client' => 'Nusantara Distribusi Logistik',
                'completion_date' => '2025',
                'external_url' => 'https://example.com/erp-logistik',
                'description' => 'Sistem ERP berbasis cloud untuk pemantauan rute armada, otomatisasi invoice logistik, dan pelacakan inventaris gudang regional.',
                'content' => "Proyek transformasi digital untuk jaringan logistik antar-pulau. Sistem ini menyatukan 14 gudang regional ke dalam satu dasbor kontrol terpusat dengan latensi data di bawah 300ms.",
                'tech_stack' => ['PHP 8.3', 'Laravel', 'Inertia.js', 'React', 'AWS ECS'],
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Kura-Kura Creative Agency Portfolio',
                'category' => 'UI/UX Design',
                'client' => 'Kura Studio Bali',
                'completion_date' => '2025',
                'external_url' => 'https://example.com/kura-studio',
                'description' => 'Eksplorasi antarmuka digital editorial dengan mikro-interaksi halus, tipografi berkarakter, dan galeri interaktif multi-dimensi.',
                'content' => "Kolaborasi desain visual dan kode interaktif untuk agensi kreatif terkemuka. Menghadirkan transisi halaman halus tanpa jeda muat dan tata letak editorial asimetris yang memenangkan penghargaan desain web internasional.",
                'tech_stack' => ['Figma', 'Tailwind CSS', 'Vite', 'Alpine.js', 'KaTeX'],
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $proj) {
            Project::firstOrCreate(
                ['slug' => Str::slug($proj['title'])],
                $proj
            );
        }

        // 4. Enhance Existing Services with benefits & tech stack
        $serviceEnhancements = [
            'web-development' => [
                'icon' => 'code-bracket',
                'benefits' => ['Arsitektur modular & terukur', 'Kecepatan muat halaman di bawah 1 detik', 'Keamanan data dan proteksi CSRF/XSS', 'Ramah mesin pencari (SEO First)'],
                'tech_stack' => ['Laravel', 'Vue.js', 'React', 'Tailwind CSS', 'PostgreSQL'],
                'is_featured' => true,
            ],
            'mobile-app-development' => [
                'icon' => 'device-phone-mobile',
                'benefits' => ['Satu basis kode untuk iOS & Android', 'Performa native yang halus 60fps', 'Integrasi push notification & offline mode', 'Penerbitan resmi di App Store & Play Store'],
                'tech_stack' => ['Flutter', 'React Native', 'Swift', 'Kotlin', 'Firebase'],
                'is_featured' => true,
            ],
            'ui-ux-design' => [
                'icon' => 'paint-brush',
                'benefits' => ['Riset mendalam kebiasaan pengguna', 'Design system yang terstandarisasi', 'Prototipe interaktif realistis', 'Uji keterbacaan dan aksesibilitas WCAG'],
                'tech_stack' => ['Figma', 'FigJam', 'Principle', 'Adobe Suite'],
                'is_featured' => true,
            ],
            'branding-identity' => [
                'icon' => 'sparkles',
                'benefits' => ['Pedoman identitas visual lengkap', 'Desain logo berfilosofi kuat', 'Harmoni palet warna dan tipografi', 'Aset media cetak dan digital'],
                'tech_stack' => ['Adobe Illustrator', 'Photoshop', 'Brand Guidelines'],
                'is_featured' => false,
            ],
            'digital-marketing' => [
                'icon' => 'chart-bar',
                'benefits' => ['Optimasi SEO on-page dan teknis', 'Pelacakan analitik dan konversi presisi', 'Strategi konten organik terarah', 'Laporan metrik performa berkala'],
                'tech_stack' => ['Google Analytics 4', 'Search Console', 'Ahrefs', 'Semrush'],
                'is_featured' => false,
            ],
        ];

        foreach ($serviceEnhancements as $slug => $enhancement) {
            $svc = Service::where('slug', $slug)->first();
            if ($svc) {
                $svc->update($enhancement);
            }
        }

        // 5. Enhance Existing Articles with category, tags, reading time
        $articleEnhancements = [
            'memadukan-seni-desain-dan-rekayasa-perangkat-lunak' => [
                'category' => 'Teknologi & Desain',
                'tags' => ['Software Engineering', 'UI/UX', 'Clean Code', 'Bali Tech'],
                'reading_time' => 5,
                'seo_title' => 'Memadukan Seni Desain dan Rekayasa Lunak | Central Saga',
                'seo_description' => 'Ulasan mendalam tentang pentingnya integrasi arsitektur kode dan estetika antarmuka dalam produk digital modern.',
            ],
            'transformasi-digital-untuk-bisnis-lokal-menuju-pasar-global' => [
                'category' => 'Strategi Bisnis',
                'tags' => ['Digital Transformation', 'Company Profile', 'Global Market'],
                'reading_time' => 4,
                'seo_title' => 'Transformasi Digital Bisnis Lokal ke Pasar Global | Central Saga',
                'seo_description' => 'Strategi membangun kehadiran digital kredibel untuk bersaing di panggung internasional dari Bali.',
            ],
        ];

        foreach ($articleEnhancements as $slug => $enhancement) {
            $art = Article::where('slug', $slug)->first();
            if ($art) {
                $art->update($enhancement);
            }
        }

        // 6. Initial Activity Logs
        ActivityLog::create([
            'user_id' => $admin?->id,
            'action' => 'SYSTEM_INIT',
            'description' => 'Inisialisasi sistem Phase 2: modul Projects, CRM pipeline, dan Media Library diaktifkan.',
            'ip_address' => '127.0.0.1',
            'created_at' => now()->subHours(2),
        ]);

        // 7. Initial Notification
        AdminNotification::create([
            'title' => 'Selamat datang di Admin v2.5',
            'message' => 'Sistem CRM, Project Management, dan Pengaturan Usaha telah siap digunakan.',
            'type' => 'system',
            'link' => '/admin',
            'is_read' => false,
            'created_at' => now()->subMinutes(30),
        ]);
    }
}
