<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    /**
     * Run demo seeds with clearly marked [CONTOH] data.
     */
    public function run(): void
    {
        $admin = User::first();

        // 5 Layanan Contoh
        $services = [
            [
                'title' => 'Web Development',
                'description' => "Pengembangan aplikasi berbasis web berkinerja tinggi, responsif, dan aman. Memadukan teknologi arsitektur modern untuk mendukung ekspansi bisnis Anda.",
                'sort_order' => 1,
            ],
            [
                'title' => 'Mobile App Development',
                'description' => "Pembuatan aplikasi mobile untuk platform iOS dan Android dengan antarmuka yang intuitif dan integrasi API yang andal.",
                'sort_order' => 2,
            ],
            [
                'title' => 'UI/UX Design',
                'description' => "Riset pengguna, pembuatan wireframe, hingga desain visual antarmuka sistem yang berpusat pada kenyamanan dan kemudahan interaksi manusia.",
                'sort_order' => 3,
            ],
            [
                'title' => 'Branding & Identity',
                'description' => "Membangun identitas visual, panduan merek, tipografi, dan aset visual yang memperkuat positioning perusahaan Anda di pasar.",
                'sort_order' => 4,
            ],
            [
                'title' => 'Digital Marketing',
                'description' => "Strategi pemasaran digital terukur, optimasi mesin pencari, dan kampanye digital untuk meningkatkan daya jangkau bisnis.",
                'sort_order' => 5,
            ],
        ];

        foreach ($services as $data) {
            Service::firstOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'is_active' => true,
                    'sort_order' => $data['sort_order'],
                ]
            );
        }

        // 2 Artikel Contoh
        $articles = [
            [
                'title' => 'Memadukan Seni Desain dan Rekayasa Perangkat Lunak',
                'excerpt' => 'Bagaimana kolaborasi erat antara perancang visual dan insinyur perangkat lunak menghasilkan produk digital yang tangguh dan estetis.',
                'content' => "Dalam ekosistem pengembangan produk digital modern, kerap terjadi pemisahan tajam antara aspek estetika dan fungsionalitas teknis. Di PT. Central Saga Mandala, kami meyakini bahwa desain yang memikat harus ditopang oleh fondasi arsitektur kode yang tangguh, modular, dan teruji.\n\nDengan mengedepankan prinsip kejelasan tujuan dalam setiap baris kode dan komponen antarmuka, aplikasi tidak hanya nyaman dipandang tetapi juga cepat dimuat serta aman digunakan.",
            ],
            [
                'title' => 'Transformasi Digital untuk Bisnis Lokal Menuju Pasar Global',
                'excerpt' => 'Langkah nyata membangun identitas digital yang kredibel bagi pelaku usaha dari Bali untuk menembus pasar internasional.',
                'content' => "Era digital memberikan peluang tanpa batas bagi bisnis berbasis daerah untuk bersaing di panggung global. Melalui website company profile berstandar profesional, kehadiran digital bisnis Anda menjadi duta utama yang membangun kepercayaan pertama bagi calon mitra kerja dari berbagai negara.",
            ],
        ];

        foreach ($articles as $art) {
            Article::firstOrCreate(
                ['slug' => Str::slug($art['title'])],
                [
                    'author_id' => $admin?->id,
                    'title' => $art['title'],
                    'excerpt' => $art['excerpt'],
                    'content' => $art['content'],
                    'status' => 'published',
                    'published_at' => now(),
                ]
            );
        }

        // 1 Testimoni Contoh (Approved)
        Testimonial::firstOrCreate(
            ['name' => 'Wayan Arya'],
            [
                'role' => 'Founder, Bali Creative Hub',
                'message' => 'Kolaborasi dengan tim Central Saga sangat menyenangkan. Desain yang dihasilkan terasa hidup dan eksekusi teknisnya solid tanpa kendala.',
                'rating' => 5,
                'status' => 'approved',
            ]
        );
    }
}

