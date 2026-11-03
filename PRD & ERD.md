PRD & ERD – Website Company Profile Software House
Versi 2.0 (Standar V2 Full-Stack) · 3 November 2026 · Status: Draft untuk review
Catatan: nama perusahaan di dokumen ini memakai placeholder [NamaPerusahaan]. Ganti sesuai brand Anda.
Cara Membaca Dokumen Ini
Dokumen ini disusun berlapis: PRD dan ERD dasar di depan, lalu tiga lampiran yang menimpa bagian dasar jika ada pertentangan. Saat dua bagian berbeda, ikuti urutan prioritas berikut.
Prioritas
Bagian
Mengatur apa
1 (tertinggi)
Lampiran C
Stack, auth, CRUD dashboard, alur form, deploy, dan penilaian (standar V2 dari mentor)
2
Lampiran B
Arah desain dari pemilik: hitam-merah, modern, kaca terbatas
3
Lampiran A
Aturan antislop, override isi PRD, dan Delivery Gate
4
Bagian 1 sampai 17 dan E1 sampai E8
PRD dasar dan skema data, berlaku selama tidak ditimpa
Peta Dokumen
Bagian
Isi
Pembaca utama
1 sampai 5
Ringkasan, masalah, KPI, persona, ruang lingkup
Pemilik, tim bisnis
6 sampai 8
Sitemap, kebutuhan fungsional publik, dan admin
Semua tim
9 sampai 13
Non-fungsional, UI/UX, tech stack, analytics, konten
Desainer, developer
14 sampai 17
Roadmap, risiko, kriteria selesai, pertanyaan terbuka
Pemilik, PM
E1 sampai E8
ERD, kamus data, indeks, kebijakan data
Developer, AI agent
Lampiran A
Antislop, Delivery Gate, master prompt
Developer, AI agent
Lampiran B
Arah desain dan keputusan yang menunggu pemilik
Pemilik, desainer
Lampiran C
Standar V2 full-stack dan checklist penilaian
Developer, AI agent, mentor
Tips tampilan: tabel di dokumen ini hanya tampil rapi di editor. Jika disalin sebagai teks polos, tiap sel terpecah menjadi satu baris. Untuk dibagikan atau diberikan ke AI agent, klik nama dokumen, pilih Export, lalu pilih Markdown, Word, atau PDF.
1. Ringkasan Eksekutif
[NamaPerusahaan] adalah software house yang melayani pembuatan aplikasi web, aplikasi mobile, sistem enterprise (ERP/CRM), integrasi AI, UI/UX design, dan layanan maintenance. Website company profile adalah etalase digital utama sekaligus mesin lead generation: tempat calon klien menilai kredibilitas, melihat portofolio, memahami layanan, lalu menghubungi tim sales.
Visi produk: website yang terasa premium, cepat, dan meyakinkan, sehingga calon klien percaya bahwa perusahaan ini mampu membangun produk kelas dunia.
Hasil yang diharapkan:
• Meningkatkan jumlah inquiry berkualitas dari website.
• Membangun kepercayaan lewat studi kasus, testimoni, dan transparansi proses.
• Menjadi aset SEO jangka panjang lewat blog dan halaman layanan.
• Menarik talenta lewat halaman karier.
2. Latar Belakang & Masalah
Masalah
Dampak
Solusi lewat website
Perusahaan baru belum dikenal
Calon klien ragu
Halaman portofolio, studi kasus, tim, dan sertifikasi
Klien bingung layanan apa yang ditawarkan
Inquiry tidak relevan
Halaman layanan terstruktur dengan use case dan proses
Proses penawaran lambat dan manual
Lead hilang
Form brief proyek terstruktur dengan notifikasi otomatis
Sulit merekrut developer
Kapasitas terbatas
Halaman karier dengan employer branding dan form lamaran
Tidak ada trafik organik
Biaya akuisisi tinggi
Blog, SEO teknis, dan schema markup
3. Tujuan Bisnis & KPI
ID
Tujuan
KPI
Target 6 bulan setelah launch
G1
Menghasilkan lead
Jumlah submit form kontak/brief
40–80 lead/bulan
G2
Konversi pengunjung
Conversion rate (visit → lead)
≥ 2,5%
G3
Kredibilitas
Rata-rata durasi sesi
≥ 2 menit 30 detik
G4
Trafik organik
Sesi organik
≥ 5.000/bulan
G5
Performa
Skor Lighthouse (mobile)
≥ 90 semua kategori
G6
Rekrutmen
Lamaran masuk via website
≥ 15/bulan
G7
Brand awareness
Pengunjung berulang
≥ 25%
4. Target Pengguna & Persona
4.1 Persona Utama
Persona 1 – Rina, Pemilik UMKM/Startup Founder (35 th)
• Butuh aplikasi/MVP tetapi tidak paham teknis.
• Kekhawatiran: harga, risiko proyek gagal, komunikasi.
• Kebutuhan: penjelasan sederhana, estimasi biaya, portofolio relevan.
Persona 2 – Budi, IT Manager/CTO Perusahaan Menengah (42 th)
• Mencari vendor untuk sistem internal/integrasi.
• Kekhawatiran: keamanan, skalabilitas, SLA, tech stack.
• Kebutuhan: detail teknis, studi kasus enterprise, sertifikasi, NDA.
Persona 3 – Sari, Procurement/Project Owner Korporasi (38 th)
• Membandingkan beberapa vendor.
• Kebutuhan: profil perusahaan, legalitas, referensi klien, proses kerja.
Persona 4 – Dimas, Software Engineer/Designer (26 th)
• Mencari tempat kerja.
• Kebutuhan: budaya kerja, tech stack, benefit, lowongan.
Persona 5 – Admin/Marketing Internal
• Mengelola konten tanpa bantuan developer.
• Kebutuhan: CMS yang mudah, melihat lead, laporan.
4.2 User Journey Utama (Calon Klien)
1. Awareness: menemukan lewat Google, LinkedIn, atau referral.
2. Consideration: membuka layanan, portofolio, studi kasus, dan tim.
3. Trust: membaca testimoni, sertifikasi, dan proses kerja.
4. Action: mengisi form brief proyek atau menjadwalkan konsultasi.
5. Follow-up: menerima email konfirmasi, tim sales menghubungi maksimal 1×24 jam kerja.
5. Ruang Lingkup
5.1 In Scope (Rilis 1.0)
• Website publik multi-halaman, responsif, dua bahasa (ID/EN).
• Admin panel/CMS untuk mengelola seluruh konten dan lead.
• Form kontak, form brief proyek, form lamaran kerja, newsletter.
• Blog/artikel dengan kategori dan tag.
• Portofolio dan studi kasus.
• SEO teknis, analytics, dan integrasi email.
• Dark/light mode.
5.2 Out of Scope (Rilis 1.0)
• Client portal/dashboard proyek.
• Sistem pembayaran/invoice online.
• Marketplace template atau produk digital.
• Live chat berbasis agen manusia 24/7 (hanya chatbot FAQ di fase 2).
5.3 Asumsi & Dependensi
• Domain, logo, dan brand guideline tersedia atau dibuat di fase desain.
• Konten awal (profil, layanan, 6+ portofolio) disiapkan tim internal.
• Layanan email transaksional (SMTP/Resend/SendGrid) tersedia.
6. Information Architecture (Sitemap)
Beranda (/)
├── Layanan (/layanan)
│   ├── Web Development
│   ├── Mobile App Development
│   ├── Enterprise System (ERP/CRM/HRIS)
│   ├── UI/UX Design
│   ├── AI & Data Solutions
│   ├── Cloud & DevOps
│   └── Maintenance & Support
├── Portofolio (/portofolio)
│   └── Detail Studi Kasus (/portofolio/[slug])
├── Industri (/industri)  [Fintech, Retail, Edukasi, Kesehatan, Logistik, dll.]
├── Tentang Kami (/tentang)
│   ├── Visi, Misi, Nilai
│   ├── Tim & Leadership
│   └── Sertifikasi & Penghargaan
├── Proses Kerja (/proses)
├── Harga & Model Kerja (/harga)
├── Blog (/blog)
│   └── Detail Artikel (/blog/[slug])
├── Karier (/karier)
│   └── Detail Lowongan (/karier/[slug])
├── FAQ (/faq)
├── Hubungi Kami (/kontak)
│   └── Brief Proyek (/mulai-proyek)
├── Halaman Legal (/privasi, /syarat, /cookie)
└── 404 / 500 / Maintenance
7. Kebutuhan Fungsional – Website Publik
Prioritas: P0 wajib rilis 1.0, P1 penting, P2 nice-to-have.
7.1 Global (Header, Footer, Navigasi)
ID
Kebutuhan
Prioritas
FR-G-01
Header sticky dengan logo, menu utama, tombol CTA "Mulai Proyek"
P0
FR-G-02
Mega menu pada "Layanan" menampilkan ikon, deskripsi singkat, dan tautan
P1
FR-G-03
Menu mobile berupa hamburger dengan animasi halus
P0
FR-G-04
Pemilih bahasa ID/EN dengan URL terpisah (/id, /en) dan hreflang
P0
FR-G-05
Toggle dark/light mode dengan menyimpan preferensi
P1
FR-G-06
Footer: alamat, kontak, tautan cepat, sosial media, newsletter, tautan legal
P0
FR-G-07
Tombol WhatsApp floating dengan pesan awal otomatis
P0
FR-G-08
Banner persetujuan cookie sesuai UU PDP
P0
FR-G-09
Breadcrumb di halaman dalam
P1
FR-G-10
Pencarian global (layanan, blog, portofolio)
P2
FR-G-11
Tombol back-to-top dan progress bar scroll pada artikel
P2
7.2 Beranda
ID
Kebutuhan
Prioritas
FR-H-01
Hero: headline kuat, subheadline, 2 CTA (Mulai Proyek, Lihat Portofolio), visual/animasi 3D atau mockup
P0
FR-H-02
Strip logo klien/partner (carousel otomatis)
P0
FR-H-03
Ringkasan layanan (6–8 kartu) dengan hover interaktif
P0
FR-H-04
Angka pencapaian animasi (proyek selesai, klien, tahun pengalaman, tim)
P0
FR-H-05
Portofolio unggulan (3–6 proyek)
P0
FR-H-06
Proses kerja singkat dalam bentuk timeline
P1
FR-H-07
Tech stack yang dikuasai (ikon teknologi)
P1
FR-H-08
Testimoni klien (carousel, foto, nama, jabatan, perusahaan)
P0
FR-H-09
Cuplikan 3 artikel blog terbaru
P1
FR-H-10
Section "Mengapa Kami" (keunggulan diferensiasi)
P0
FR-H-11
CTA penutup dengan form singkat (nama, email, kebutuhan)
P0
7.3 Layanan
ID
Kebutuhan
Prioritas
FR-S-01
Halaman indeks layanan dengan grid kartu dan filter kategori
P0
FR-S-02
Halaman detail per layanan: deskripsi, manfaat, use case, deliverable, tech stack, proses, FAQ spesifik, proyek terkait, CTA
P0
FR-S-03
Setiap layanan punya meta SEO, Open Graph, dan schema Service sendiri
P0
FR-S-04
Bagian "Cocok untuk" berdasarkan industri/tahap bisnis
P1
FR-S-05
Kalkulator estimasi awal (pilih jenis proyek, fitur, urgensi → rentang biaya & durasi)
P1
7.4 Portofolio & Studi Kasus
ID
Kebutuhan
Prioritas
FR-P-01
Grid portofolio dengan filter (layanan, industri, teknologi) dan pagination/infinite scroll
P0
FR-P-02
Detail studi kasus: ringkasan klien, tantangan, solusi, proses, hasil terukur, tech stack, galeri gambar/video, testimoni
P0
FR-P-03
Galeri dengan lightbox dan video demo (embed YouTube/Vimeo)
P1
FR-P-04
Opsi menyamarkan nama klien (NDA)
P0
FR-P-05
Navigasi proyek sebelumnya/berikutnya
P2
FR-P-06
Unduh PDF studi kasus dengan syarat mengisi email (lead magnet)
P2
7.5 Tentang Kami & Tim
ID
Kebutuhan
Prioritas
FR-A-01
Cerita perusahaan, visi, misi, nilai budaya
P0
FR-A-02
Timeline perjalanan perusahaan
P1
FR-A-03
Profil tim: foto, nama, jabatan, bio singkat, tautan LinkedIn
P0
FR-A-04
Sertifikasi, kemitraan (AWS, Google Cloud, dll.), penghargaan, legalitas (NIB, NPWP)
P0
FR-A-05
Galeri budaya kerja dan kantor
P1
FR-A-06
Dampak sosial/CSR bila ada
P2
7.6 Proses Kerja & Harga
ID
Kebutuhan
Prioritas
FR-W-01
Visualisasi tahap: Discovery → Desain → Development → QA → Deployment → Maintenance
P0
FR-W-02
Penjelasan metodologi (Agile/Scrum), komunikasi, dan tools (Jira, Slack, Figma)
P1
FR-W-03
Perbandingan model kerja: Fixed Price, Time & Material, Dedicated Team
P0
FR-W-04
Paket indikatif (Starter, Growth, Enterprise) dengan catatan "mulai dari"
P1
FR-W-05
Tabel garansi, SLA, dan kebijakan revisi
P1
7.7 Blog
ID
Kebutuhan
Prioritas
FR-B-01
Daftar artikel dengan kategori, tag, pencarian, dan pagination
P0
FR-B-02
Detail artikel: judul, penulis, tanggal, estimasi waktu baca, daftar isi otomatis, tombol share
P0
FR-B-03
Syntax highlighting untuk blok kode
P1
FR-B-04
Artikel terkait dan CTA kontekstual di akhir artikel
P0
FR-B-05
RSS feed dan sitemap otomatis
P1
FR-B-06
Komentar atau reaksi (opsional, moderasi)
P2
FR-B-07
Penjadwalan publikasi dan status draft
P0
7.8 Karier
ID
Kebutuhan
Prioritas
FR-C-01
Daftar lowongan dengan filter departemen, lokasi, tipe kerja (onsite/hybrid/remote)
P0
FR-C-02
Detail lowongan: tanggung jawab, kualifikasi, benefit, rentang gaji (opsional)
P0
FR-C-03
Form lamaran: data diri, CV (PDF ≤ 5 MB), portofolio/GitHub, cover letter, ekspektasi gaji
P0
FR-C-04
Email konfirmasi otomatis ke pelamar
P0
FR-C-05
Opsi "talent pool" bila tidak ada lowongan sesuai
P1
FR-C-06
Schema JobPosting untuk Google Jobs
P1
7.9 Kontak & Brief Proyek
ID
Kebutuhan
Prioritas
FR-K-01
Form kontak: nama, email, telepon, perusahaan, subjek, pesan
P0
FR-K-02
Form brief proyek multi-langkah: (1) jenis proyek, (2) deskripsi & fitur, (3) anggaran & timeline, (4) data kontak, (5) unggah lampiran (maks 3 file, 10 MB total)
P0
FR-K-03
Validasi sisi klien dan server, perlindungan spam (reCAPTCHA/Turnstile + honeypot + rate limit)
P0
FR-K-04
Notifikasi email ke tim sales dan konfirmasi otomatis ke pengirim
P0
FR-K-05
Penjadwalan konsultasi lewat integrasi kalender (Calendly/Cal.com/Google Calendar)
P1
FR-K-06
Peta lokasi (Google Maps embed), jam kerja, dan kanal kontak lain
P0
FR-K-07
Simpan UTM dan sumber trafik pada setiap lead
P1
FR-K-08
Opsi menandatangani NDA sebelum berbagi detail (unggah/kirim template)
P2
7.10 FAQ, Legal, dan Lainnya
ID
Kebutuhan
Prioritas
FR-F-01
FAQ dalam bentuk accordion, dikelompokkan per kategori, dengan schema FAQPage
P0
FR-F-02
Halaman Kebijakan Privasi, Syarat & Ketentuan, Kebijakan Cookie
P0
FR-F-03
Halaman 404 kreatif dengan tautan bantuan
P0
FR-F-04
Mode maintenance yang dapat diaktifkan dari admin
P1
FR-F-05
Chatbot AI untuk FAQ dan kualifikasi lead awal (Fase 2)
P2
8. Kebutuhan Fungsional – Admin Panel (CMS)
8.1 Peran & Hak Akses
Peran
Hak Akses
Super Admin
Seluruh fitur, pengaturan sistem, manajemen pengguna, audit log
Admin
Seluruh konten, lead, lamaran, dan pengaturan situs (tanpa pengaturan sistem)
Editor/Content Writer
Membuat dan mengedit blog, portofolio, FAQ; tidak dapat publikasi bila diwajibkan approval
Sales/Marketing
Melihat dan mengelola lead, brief proyek, newsletter, analitik
HR
Mengelola lowongan dan lamaran
8.2 Modul Admin
ID
Modul
Fitur
FR-AD-01
Autentikasi
Login email+password, 2FA (TOTP), lupa/reset password, sesi dengan timeout, pembatasan percobaan login
FR-AD-02
Dashboard
Ringkasan lead baru, lamaran baru, trafik, artikel populer, tugas tertunda
FR-AD-03
Manajemen Halaman
Edit konten halaman statis (Beranda, Tentang, Proses) dengan editor blok, pratinjau, versi, dan jadwal
FR-AD-04
Manajemen Layanan
CRUD layanan, urutan tampil, ikon, SEO per halaman
FR-AD-05
Manajemen Portofolio
CRUD proyek, galeri, metrik hasil, relasi layanan/industri/teknologi, status tampil
FR-AD-06
Manajemen Blog
Editor rich text/Markdown, kategori, tag, penulis, thumbnail, jadwal, status draft/review/publish
FR-AD-07
Manajemen Tim
CRUD anggota tim, urutan, status tampil
FR-AD-08
Testimoni & Klien
CRUD testimoni dan logo klien
FR-AD-09
Manajemen Lead
Daftar lead, filter status (Baru, Dihubungi, Kualifikasi, Proposal, Menang, Kalah), catatan internal, penugasan ke sales, ekspor CSV
FR-AD-10
Karier & Lamaran
CRUD lowongan, daftar pelamar, status (Baru, Screening, Interview, Offer, Ditolak), unduh CV
FR-AD-11
Newsletter
Daftar subscriber, ekspor, status opt-in/opt-out; sinkron ke Mailchimp/Brevo
FR-AD-12
Media Library
Unggah, kompresi otomatis, alt text, folder, penghapusan aman
FR-AD-13
SEO Manager
Meta title/description, OG image, canonical, robots, redirect 301
FR-AD-14
Pengaturan Situs
Logo, warna brand, kontak, sosial media, skrip analytics, bahasa, mode maintenance
FR-AD-15
Pengguna & Peran
CRUD pengguna, penetapan peran, undangan via email
FR-AD-16
Audit Log
Catatan siapa mengubah apa dan kapan
FR-AD-17
Notifikasi
Email/Slack/Telegram untuk lead dan lamaran baru
9. Kebutuhan Non-Fungsional
9.1 Performa
• LCP ≤ 2,5 detik, INP ≤ 200 ms, CLS ≤ 0,1 pada koneksi 4G.
• TTFB ≤ 600 ms melalui CDN dan caching.
• Gambar format WebP/AVIF dengan lazy loading dan ukuran responsif.
• Total bobot halaman beranda ≤ 2 MB (di luar video).
9.2 SEO
• Server-side rendering/static generation untuk semua halaman publik.
• Meta tag, Open Graph, Twitter Card, canonical, dan hreflang per halaman.
• Schema.org: Organization, LocalBusiness, Service, Article, FAQPage, JobPosting, BreadcrumbList.
• sitemap.xml dan robots.txt otomatis, URL bersih dan konsisten.
• Integrasi Google Search Console dan Bing Webmaster.
9.3 Keamanan
• HTTPS wajib dengan HSTS; header keamanan (CSP, X-Frame-Options, Referrer-Policy).
• Proteksi OWASP Top 10: SQL injection, XSS, CSRF, SSRF, IDOR.
• Hash password dengan Argon2/bcrypt, enkripsi data sensitif saat disimpan.
• Rate limiting pada form dan endpoint login, validasi dan pemindaian file unggahan.
• Backup database harian, retensi 30 hari, uji restore berkala.
• Kepatuhan UU Pelindungan Data Pribadi (UU PDP): persetujuan eksplisit, hak hapus data, kebijakan retensi.
9.4 Aksesibilitas
• Mengikuti WCAG 2.2 level AA: kontras warna, navigasi keyboard, label ARIA, alt text, fokus terlihat.
• Mendukung prefers-reduced-motion.
9.5 Kompatibilitas
• Browser: dua versi terbaru Chrome, Edge, Firefox, Safari; Safari iOS dan Chrome Android.
• Breakpoint: 360, 768, 1024, 1280, 1536 px.
9.6 Ketersediaan & Skalabilitas
• Uptime ≥ 99,9%, monitoring dengan alert (UptimeRobot/Better Stack).
• Arsitektur siap menangani lonjakan 10× trafik lewat CDN dan edge caching.
9.7 Maintainability
• Kode terdokumentasi, lint dan format otomatis, test coverage ≥ 70% untuk logika kritis.
• CI/CD otomatis dengan environment staging dan production.
10. UI/UX & Brand Direction
10.1 Prinsip Desain
1. Premium & modern: tipografi tegas, ruang kosong lapang, grid rapi.
2. Kredibel: bukti nyata (angka, logo klien, studi kasus) di setiap titik keputusan.
3. Cepat dipahami: pesan utama terbaca dalam 5 detik.
4. Berorientasi aksi: CTA jelas dan konsisten.
5. Hidup tetapi tidak berlebihan: animasi halus yang mendukung konten.
10.2 Rekomendasi Visual
• Palet: warna primer biru/indigo atau teal sebagai kesan teknologi tepercaya, aksen cerah (lime/orange) untuk CTA, netral gelap-terang untuk latar.
• Tipografi: heading Plus Jakarta Sans / Sora / Space Grotesk; body Inter; kode JetBrains Mono.
• Komponen: kartu dengan sudut membulat, gradient halus, glassmorphism terbatas, ikon konsisten (Lucide/Phosphor).
• Animasi: scroll reveal, hover micro-interaction, hero interaktif (Three.js/Lottie) dengan fallback statis.
• Gambar: mockup perangkat, ilustrasi kustom, foto tim asli (hindari stok generik).
10.3 Deliverable Desain
• Moodboard dan brand guideline ringkas.
• Wireframe low-fi seluruh halaman, lalu high-fi di Figma (desktop, tablet, mobile).
• Design system: token warna, tipografi, spasi, komponen, dan state (default, hover, focus, disabled, error).
• Prototipe interaktif untuk alur brief proyek dan beranda.
11. Arsitektur & Tech Stack yang Direkomendasikan
Pilihan yang menyeimbangkan performa, SEO, dan kemudahan pengelolaan:
Lapisan
Rekomendasi
Alternatif
Frontend
Next.js (App Router) + TypeScript
Nuxt, Astro
Styling
Tailwind CSS + shadcn/ui, Framer Motion
CSS Modules
Backend/API
Next.js Route Handlers atau NestJS
Laravel, Express
CMS
Custom admin atau Payload CMS / Strapi
Sanity, Directus
Database
PostgreSQL
MySQL
ORM
Prisma / Drizzle
TypeORM
Penyimpanan file
S3-compatible (Cloudflare R2/AWS S3)
Supabase Storage
Email
Resend / SendGrid / Amazon SES
SMTP
Cache & queue
Redis
–
Pencarian
Postgres full-text
Meilisearch/Algolia
Hosting
Vercel atau VPS (Docker) + Cloudflare CDN
AWS, GCP
CI/CD
GitHub Actions
GitLab CI
Monitoring
Sentry, Better Stack, Google Analytics 4, Plausible/PostHog
–
Anti-spam
Cloudflare Turnstile
reCAPTCHA v3
Environment: local → staging → production, dengan variabel rahasia di secret manager.
12. Analytics & Pelacakan
• Event utama: click_cta, view_service, view_case_study, start_brief, submit_brief, submit_contact, apply_job, download_pdf, click_whatsapp, subscribe_newsletter.
• Atribusi: simpan UTM source/medium/campaign pada lead.
• Tools: GA4, Google Tag Manager, Microsoft Clarity/Hotjar untuk heatmap, Search Console.
• Dashboard internal: funnel kunjungan → klik CTA → mulai brief → submit.
• Privasi: pelacakan hanya aktif setelah persetujuan cookie.
13. Strategi Konten
Jenis
Jumlah Minimum Saat Launch
Catatan
Halaman layanan
6–7
600–1.000 kata, dengan use case dan FAQ
Studi kasus
4–6
Format masalah → solusi → hasil terukur
Artikel blog
8–10
Topik: panduan memilih software house, biaya pembuatan aplikasi, tren teknologi
Profil tim
Seluruh tim inti
Foto profesional seragam
Testimoni
5+
Dengan izin tertulis klien
FAQ
15–20
Biaya, durasi, garansi, kepemilikan kode, NDA
Rencana blog bulanan: 4 artikel (2 edukasi bisnis, 1 teknis, 1 studi kasus/berita perusahaan).
14. Rencana Rilis & Milestone
Fase
Durasi
Deliverable
0. Discovery
1 minggu
Finalisasi PRD, sitemap, brand, kompetitor benchmark
1. UX & Desain
3 minggu
Wireframe, design system, UI high-fi, prototipe
2. Development Frontend
4 minggu
Halaman publik, komponen, animasi, responsif
3. Development Backend & CMS
4 minggu (paralel)
API, database, admin, form, email, autentikasi
4. Integrasi & Konten
2 minggu
Mengisi konten, SEO on-page, analytics, i18n
5. QA & Optimasi
2 minggu
Pengujian fungsional, performa, keamanan, aksesibilitas, UAT
6. Launch
1 minggu
Deploy production, DNS, monitoring, hypercare
7. Pasca-launch
Berkelanjutan
Iterasi berdasarkan data, A/B test, chatbot (Fase 2)
Estimasi total: ± 12–14 minggu.
Fase 2 (setelah launch): chatbot AI, client portal ringan, kalkulator estimasi lanjutan, studi kasus video, program referral.
15. Risiko & Mitigasi
Risiko
Kemungkinan
Dampak
Mitigasi
Konten terlambat disiapkan
Tinggi
Tinggi
Tetapkan penanggung jawab konten dan tenggat sejak fase 0
Portofolio awal sedikit
Sedang
Tinggi
Buat proyek internal/demo dan studi kasus konsep
Animasi berat menurunkan performa
Sedang
Sedang
Budget performa, lazy load, fallback statis
Lead berupa spam
Tinggi
Sedang
Turnstile, honeypot, rate limit, validasi
Pelanggaran data pribadi
Rendah
Tinggi
Enkripsi, kontrol akses, kebijakan retensi, audit
Scope creep
Sedang
Sedang
Pembekuan scope per fase, proses change request
Kualitas terjemahan EN rendah
Sedang
Sedang
Review penutur asli atau proofreader profesional
16. Acceptance Criteria & Definition of Done
• Semua kebutuhan P0 terimplementasi dan lolos UAT.
• Lighthouse mobile ≥ 90 (Performance, Accessibility, Best Practices, SEO) pada beranda dan 3 halaman utama lain.
• Tidak ada bug kritis/mayor terbuka; bug minor terdokumentasi.
• Form menghasilkan email notifikasi dan tersimpan di database dalam ≤ 5 detik.
• Uji keamanan dasar (OWASP checklist) dan pemindaian dependensi tanpa kerentanan kritis.
• Seluruh halaman memiliki meta SEO, OG image, dan tampil benar di mobile.
• Dokumentasi teknis, panduan admin, dan pelatihan singkat tim konten selesai.
• Backup, monitoring, dan alert aktif di production.
17. Daftar Pertanyaan Terbuka
1. Nama perusahaan, tagline, dan identitas visual final?
2. Bahasa yang diwajibkan saat launch: ID saja atau ID + EN?
3. Apakah harga/paket akan ditampilkan publik atau hanya "hubungi kami"?
4. Siapa pemilik konten dan siapa yang menyetujui publikasi?
5. Target pasar: lokal (Indonesia), regional ASEAN, atau global?
6. Preferensi hosting dan anggaran infrastruktur bulanan?
ERD – Entity Relationship Diagram
E1. Gambaran Umum Model Data
Database relasional (PostgreSQL) dengan konvensi berikut:
• Primary key: id bertipe UUID (uuid_generate_v4()).
• Seluruh tabel memiliki created_at, updated_at; tabel konten memiliki deleted_at (soft delete).
• Dukungan dua bahasa memakai tabel terjemahan *_translations (kolom locale: id / en), sehingga konten dapat ditambah bahasa baru tanpa mengubah skema.
• Status memakai ENUM atau tabel referensi.
Kelompok Entitas
1. Akses & Keamanan: users, roles, permissions, role_permissions, sessions, audit_logs
2. Konten Inti: pages, services, industries, technologies, projects (portofolio), clients, testimonials, team_members, awards, faqs
3. Blog: posts, post_categories, tags, post_tags
4. Lead & Komunikasi: leads, project_briefs, brief_attachments, lead_notes, newsletter_subscribers, contact_messages
5. Karier: job_openings, job_applications, application_status_history
6. Sistem: media_files, site_settings, seo_metadata, redirects, menu_items, cookie_consents
E2. Diagram ERD (Mermaid)
erDiagram
    USERS ||--o{ POSTS : writes
    USERS }o--|| ROLES : has
    ROLES ||--o{ ROLE_PERMISSIONS : grants
    PERMISSIONS ||--o{ ROLE_PERMISSIONS : included_in
    USERS ||--o{ AUDIT_LOGS : performs
    USERS ||--o{ LEADS : assigned_to
    USERS ||--o{ SESSIONS : owns

    SERVICES ||--o{ SERVICE_TRANSLATIONS : has
    SERVICES ||--o{ PROJECT_SERVICES : used_in
    PROJECTS ||--o{ PROJECT_SERVICES : covers
    PROJECTS ||--o{ PROJECT_TRANSLATIONS : has
    PROJECTS }o--o| CLIENTS : for
    PROJECTS }o--o| INDUSTRIES : belongs_to
    PROJECTS ||--o{ PROJECT_TECHNOLOGIES : uses
    TECHNOLOGIES ||--o{ PROJECT_TECHNOLOGIES : used_by
    PROJECTS ||--o{ PROJECT_MEDIA : has
    MEDIA_FILES ||--o{ PROJECT_MEDIA : referenced
    PROJECTS ||--o{ PROJECT_METRICS : achieves
    TESTIMONIALS }o--o| CLIENTS : from
    TESTIMONIALS }o--o| PROJECTS : about
    INDUSTRIES ||--o{ INDUSTRY_TRANSLATIONS : has

    POSTS }o--|| POST_CATEGORIES : in
    POSTS ||--o{ POST_TAGS : tagged
    TAGS ||--o{ POST_TAGS : applied
    POSTS ||--o{ POST_TRANSLATIONS : has
    POSTS }o--o| MEDIA_FILES : cover

    LEADS ||--o| PROJECT_BRIEFS : submits
    PROJECT_BRIEFS ||--o{ BRIEF_ATTACHMENTS : has
    LEADS ||--o{ LEAD_NOTES : has
    USERS ||--o{ LEAD_NOTES : writes
    LEADS ||--o{ LEAD_STATUS_HISTORY : tracks

    JOB_OPENINGS ||--o{ JOB_APPLICATIONS : receives
    JOB_APPLICATIONS ||--o{ APPLICATION_STATUS_HISTORY : tracks
    JOB_OPENINGS ||--o{ JOB_TRANSLATIONS : has

    PAGES ||--o{ PAGE_TRANSLATIONS : has
    PAGES ||--o| SEO_METADATA : has
    TEAM_MEMBERS ||--o{ TEAM_TRANSLATIONS : has
    FAQS ||--o{ FAQ_TRANSLATIONS : has
E3. Kamus Data (Data Dictionary)
E3.1 Akses & Keamanan
roles
Kolom
Tipe
Constraint
Keterangan
id
UUID
PK

name
VARCHAR(50)
UNIQUE, NOT NULL
super_admin, admin, editor, sales, hr
description
TEXT


permissions
Kolom
Tipe
Constraint
Keterangan
id
UUID
PK

code
VARCHAR(100)
UNIQUE, NOT NULL
contoh: post.publish, lead.export
description
TEXT


role_permissions: role_id (FK → roles), permission_id (FK → permissions), PK komposit (role_id, permission_id).
users
Kolom
Tipe
Constraint
Keterangan
id
UUID
PK

role_id
UUID
FK → roles, NOT NULL

full_name
VARCHAR(150)
NOT NULL

email
VARCHAR(190)
UNIQUE, NOT NULL

password_hash
VARCHAR(255)
NOT NULL
Argon2/bcrypt
avatar_media_id
UUID
FK → media_files, NULL

two_factor_secret
VARCHAR(255)
NULL
Terenkripsi
two_factor_enabled
BOOLEAN
DEFAULT false

is_active
BOOLEAN
DEFAULT true

failed_login_count
INT
DEFAULT 0

locked_until
TIMESTAMPTZ
NULL

last_login_at
TIMESTAMPTZ
NULL

created_at / updated_at / deleted_at
TIMESTAMPTZ


sessions: id, user_id (FK), token_hash, ip_address, user_agent, expires_at, revoked_at, created_at.
audit_logs: id, user_id (FK, NULL), action (CREATE/UPDATE/DELETE/LOGIN/EXPORT), entity_type, entity_id, old_values (JSONB), new_values (JSONB), ip_address, user_agent, created_at.
E3.2 Konten Inti
services
Kolom
Tipe
Constraint
Keterangan
id
UUID
PK

slug
VARCHAR(150)
UNIQUE, NOT NULL

icon
VARCHAR(100)

Nama ikon/URL
cover_media_id
UUID
FK → media_files, NULL

sort_order
INT
DEFAULT 0

is_published
BOOLEAN
DEFAULT false

created_at / updated_at / deleted_at
TIMESTAMPTZ


service_translations: id, service_id (FK), locale, name, tagline, summary, description (rich text), benefits (JSONB), deliverables (JSONB), process_steps (JSONB), faq_json (JSONB). UNIQUE (service_id, locale).
industries + industry_translations: id, slug, icon, sort_order; terjemahan: name, description.
technologies: id, name, slug, category (frontend/backend/mobile/database/cloud/ai/tools), logo_media_id (FK), website_url, sort_order, is_featured.
clients: id, name, slug, logo_media_id (FK), website_url, industry_id (FK), is_name_public (BOOLEAN, untuk NDA), is_featured, sort_order, created_at, updated_at.
projects (portofolio / studi kasus)
Kolom
Tipe
Constraint
Keterangan
id
UUID
PK

slug
VARCHAR(180)
UNIQUE, NOT NULL

client_id
UUID
FK → clients, NULL

industry_id
UUID
FK → industries, NULL

cover_media_id
UUID
FK → media_files

project_url
VARCHAR(255)
NULL
Tautan live
started_at / completed_at
DATE
NULL

duration_months
SMALLINT
NULL

team_size
SMALLINT
NULL

is_featured
BOOLEAN
DEFAULT false
Tampil di beranda
is_published
BOOLEAN
DEFAULT false

published_at
TIMESTAMPTZ
NULL

sort_order
INT
DEFAULT 0

created_at / updated_at / deleted_at
TIMESTAMPTZ


project_translations: id, project_id (FK), locale, title, summary, challenge, solution, result, content (rich text). UNIQUE (project_id, locale).
project_services: project_id (FK), service_id (FK); PK komposit.
project_technologies: project_id (FK), technology_id (FK); PK komposit.
project_media: id, project_id (FK), media_id (FK), type (image/video), caption, sort_order.
project_metrics: id, project_id (FK), label (mis. "Pertumbuhan transaksi"), value (mis. "+150%"), sort_order.
testimonials: id, client_id (FK, NULL), project_id (FK, NULL), author_name, author_title, author_company, author_photo_media_id (FK), rating (SMALLINT 1–5), is_published, sort_order, created_at. Terjemahan: testimonial_translations (testimonial_id, locale, content).
team_members: id, full_name, photo_media_id (FK), linkedin_url, github_url, email_public, sort_order, is_leadership, is_published. Terjemahan: team_translations (team_member_id, locale, position, bio).
awards: id, title, issuer, year, logo_media_id (FK), type (certification/award/partnership), url, sort_order.
faqs: id, category (general/pricing/process/technical/career), service_id (FK, NULL), sort_order, is_published. Terjemahan: faq_translations (faq_id, locale, question, answer).
pages (halaman statis): id, slug, template, is_published, created_at, updated_at. page_translations: id, page_id (FK), locale, title, blocks (JSONB, struktur section), UNIQUE (page_id, locale).
E3.3 Blog
post_categories: id, slug, sort_order. Terjemahan: post_category_translations (category_id, locale, name, description).
tags: id, slug, name.
posts
Kolom
Tipe
Constraint
Keterangan
id
UUID
PK

slug
VARCHAR(200)
UNIQUE, NOT NULL

author_id
UUID
FK → users, NOT NULL

category_id
UUID
FK → post_categories

cover_media_id
UUID
FK → media_files

status
ENUM
draft/review/scheduled/published/archived

scheduled_at
TIMESTAMPTZ
NULL

published_at
TIMESTAMPTZ
NULL

reading_time_min
SMALLINT

Dihitung otomatis
view_count
INT
DEFAULT 0

is_featured
BOOLEAN
DEFAULT false

created_at / updated_at / deleted_at
TIMESTAMPTZ


post_translations: id, post_id (FK), locale, title, excerpt, content (rich text/Markdown), search_vector (TSVECTOR). UNIQUE (post_id, locale).
post_tags: post_id (FK), tag_id (FK); PK komposit.
E3.4 Lead & Komunikasi
leads
Kolom
Tipe
Constraint
Keterangan
id
UUID
PK

source_type
ENUM
contact_form/project_brief/whatsapp/newsletter/event

full_name
VARCHAR(150)
NOT NULL

email
VARCHAR(190)
NOT NULL

phone
VARCHAR(30)
NULL

company_name
VARCHAR(150)
NULL

job_title
VARCHAR(100)
NULL

status
ENUM
new/contacted/qualified/proposal/won/lost/spam

assigned_to
UUID
FK → users, NULL

priority
ENUM
low/medium/high

utm_source / utm_medium / utm_campaign / utm_term / utm_content
VARCHAR(100)
NULL

referrer_url
VARCHAR(500)
NULL

landing_page
VARCHAR(500)
NULL

locale
VARCHAR(5)


ip_address
INET
NULL

consent_privacy
BOOLEAN
NOT NULL
Persetujuan UU PDP
consent_at
TIMESTAMPTZ


created_at / updated_at
TIMESTAMPTZ


project_briefs: id, lead_id (FK, UNIQUE), project_type (web/mobile/enterprise/uiux/ai/other), project_name, description, features (JSONB), budget_range (ENUM), timeline_range (ENUM), has_existing_system (BOOLEAN), reference_links (JSONB), additional_notes, created_at.
brief_attachments: id, brief_id (FK), media_id (FK), original_name, size_bytes, mime_type, virus_scan_status, created_at.
lead_notes: id, lead_id (FK), user_id (FK), note, created_at.
lead_status_history: id, lead_id (FK), from_status, to_status, changed_by (FK → users), created_at.
contact_messages: id, lead_id (FK), subject, message, is_read, replied_at, created_at.
newsletter_subscribers: id, email (UNIQUE), full_name, status (pending/subscribed/unsubscribed), confirm_token, confirmed_at, unsubscribed_at, source, created_at.
E3.5 Karier
job_openings: id, slug (UNIQUE), department, employment_type (full_time/part_time/contract/internship), work_mode (onsite/hybrid/remote), location, salary_min, salary_max, salary_currency, show_salary (BOOLEAN), status (draft/open/closed), opened_at, closes_at, created_by (FK → users), created_at, updated_at. Terjemahan: job_translations (job_id, locale, title, description, responsibilities, requirements, benefits).
job_applications
Kolom
Tipe
Constraint
Keterangan
id
UUID
PK

job_id
UUID
FK → job_openings, NULL
NULL = talent pool
full_name
VARCHAR(150)
NOT NULL

email
VARCHAR(190)
NOT NULL

phone
VARCHAR(30)


cv_media_id
UUID
FK → media_files

portfolio_url
VARCHAR(255)


github_url / linkedin_url
VARCHAR(255)


cover_letter
TEXT


expected_salary
NUMERIC(14,2)


available_from
DATE


status
ENUM
new/screening/interview/offer/hired/rejected/withdrawn

rating
SMALLINT
NULL
Skor internal 1–5
consent_privacy
BOOLEAN
NOT NULL

created_at / updated_at
TIMESTAMPTZ


application_status_history: id, application_id (FK), from_status, to_status, note, changed_by (FK → users), created_at.
E3.6 Sistem
media_files: id, uploaded_by (FK → users), storage_key, url, original_name, mime_type, size_bytes, width, height, alt_text, folder, is_public (BOOLEAN), checksum_sha256, created_at, deleted_at.
site_settings: id, key (UNIQUE), value (JSONB), group (general/contact/social/analytics/appearance), updated_by (FK), updated_at.
seo_metadata: id, entity_type (page/service/project/post/job), entity_id, locale, meta_title, meta_description, og_image_media_id (FK), canonical_url, robots (index,follow / noindex), schema_json (JSONB). UNIQUE (entity_type, entity_id, locale).
redirects: id, from_path (UNIQUE), to_path, status_code (301/302), hit_count, is_active, created_at.
menu_items: id, menu_location (header/footer), parent_id (FK self, NULL), url, sort_order, is_active, open_in_new_tab. Terjemahan: menu_item_translations (menu_item_id, locale, label).
cookie_consents: id, visitor_id, necessary, analytics, marketing, ip_hash, user_agent, policy_version, created_at.
E4. Relasi & Kardinalitas Utama
Relasi
Kardinalitas
Keterangan
roles ↔ permissions
M:N via role_permissions
Kontrol akses berbasis peran (RBAC)
users → roles
N:1
Satu pengguna satu peran
users → posts
1:N
Penulis artikel
projects ↔ services
M:N via project_services
Satu proyek bisa mencakup banyak layanan
projects ↔ technologies
M:N via project_technologies
Tech stack proyek
projects → clients
N:1 (opsional)
Klien bisa disamarkan
posts ↔ tags
M:N via post_tags

posts → post_categories
N:1

leads → project_briefs
1:0..1
Brief hanya ada jika lewat form brief
project_briefs → brief_attachments
1:N

leads → lead_notes / lead_status_history
1:N
Riwayat penanganan lead
job_openings → job_applications
1:N
job_id NULL untuk talent pool
entitas konten → *_translations
1:N
Satu baris per bahasa
entitas konten → seo_metadata
1:N (per locale)
Relasi polimorfik
E5. Indeks & Optimasi
Tabel
Indeks
Tujuan
semua tabel dengan slug
UNIQUE (slug)
Pencarian halaman cepat
posts
(status, published_at DESC)
Daftar blog
post_translations
GIN (search_vector)
Pencarian teks penuh
projects
(is_published, is_featured, sort_order)
Portofolio & beranda
leads
(status, created_at DESC), (assigned_to), (email)
Dashboard sales
leads
(utm_source, utm_campaign)
Laporan atribusi
job_applications
(job_id, status)
Dashboard HR
audit_logs
(entity_type, entity_id), (created_at)
Penelusuran
seo_metadata
UNIQUE (entity_type, entity_id, locale)
Integritas data
media_files
(folder), (checksum_sha256)
Mencegah duplikasi
Aturan integritas:
• ON DELETE RESTRICT untuk relasi ke users dan roles.
• ON DELETE CASCADE untuk tabel terjemahan, lampiran, dan tabel pivot.
• ON DELETE SET NULL untuk referensi opsional ke media_files dan clients.
• Konten publik memakai soft delete; data pribadi (lead, lamaran) dihapus permanen atau dianonimkan sesuai kebijakan retensi.
E6. Kebijakan Data & Kepatuhan UU PDP
Data
Retensi
Perlakuan
Lead tanpa transaksi
24 bulan sejak kontak terakhir
Anonimkan atau hapus otomatis
Lamaran kerja
12 bulan (24 bulan jika masuk talent pool dengan izin)
Hapus CV dan data pribadi
Subscriber newsletter
Selama berlangganan
Hapus saat berhenti atau diminta
Log audit
24 bulan
Arsipkan lalu hapus
Cookie consent
12 bulan
Minta ulang persetujuan
Lampiran brief proyek
12 bulan
Hapus dari storage; berlaku NDA bila ada
• Data sensitif (two_factor_secret, lampiran) dienkripsi saat disimpan.
• Alamat IP pada cookie_consents disimpan dalam bentuk hash.
• Tersedia fitur "Hapus data saya" (hak subjek data): admin dapat menghapus/anonimkan lead, lamaran, dan subscriber dalam satu aksi.
• Ekspor data subjek (portabilitas) dalam format JSON/CSV.
E7. Contoh Query Penting
-- Portofolio unggulan di beranda (bahasa Indonesia)
SELECT p.slug, pt.title, pt.summary, m.url AS cover
FROM projects p
JOIN project_translations pt ON pt.project_id = p.id AND pt.locale = 'id'
LEFT JOIN media_files m ON m.id = p.cover_media_id
WHERE p.is_published = true AND p.is_featured = true AND p.deleted_at IS NULL
ORDER BY p.sort_order, p.published_at DESC
LIMIT 6;

-- Funnel lead per sumber bulan ini
SELECT utm_source, status, COUNT(*) AS total
FROM leads
WHERE created_at >= date_trunc('month', now())
GROUP BY utm_source, status
ORDER BY utm_source, total DESC;

-- Lamaran baru per lowongan
SELECT j.slug, COUNT(a.id) AS pelamar_baru
FROM job_openings j
LEFT JOIN job_applications a ON a.job_id = j.id AND a.status = 'new'
GROUP BY j.slug;
E8. Langkah Selanjutnya
1. Review PRD dan ERD bersama tim, lalu jawab daftar pertanyaan terbuka (bagian 17).
2. Finalisasi nama, brand, dan sitemap.
3. Mulai desain wireframe dan UI di Figma.
4. Siapkan skema database (migrasi Prisma/SQL) dari ERD ini.
5. Susun backlog (epic → user story → task) berdasarkan ID kebutuhan FR-xx.
LAMPIRAN A: Antislop Execution Spec (WAJIB DIIKUTI AI AGENT)
Status dokumen ini: mengikat. Lampiran A menimpa (override) bagian PRD dan ERD di atas jika ada yang bertentangan. Ketika AI coding agent diperintah "bangun website ini", agent wajib membaca Lampiran A terlebih dahulu, menerapkan aturannya selama membangun (mode DURING), dan menjalankan Delivery Gate di akhir.
Tujuan: hasil akhir terasa dirancang oleh desainer, bukan dihasilkan oleh AI. Antislop adalah filter, bukan pemberi arah. Arah visual datang dari pemilik (bagian A2).
A1. Prinsip Inti
1. Setiap teknik visual harus lolos uji tujuan: apa yang dilayaninya? Tulis alasannya satu baris. Jika satu-satunya alasan adalah "biasanya begitu" atau "terlihat aman", teknik itu dibuang atau dikerjakan ulang.
2. Menghapus slop tidak otomatis menghasilkan desain bagus. Kehidupan harus ditambahkan lewat arah visual, tiga dial, dan identity motif (A4).
3. Tes akhir: jika logo dan nama perusahaan diganti, apakah desain ini masih terasa unik? Jika tidak, ulangi.
4. Data apa pun yang tampil sebagai fakta harus nyata dan dapat diverifikasi, atau tidak tampil sama sekali.
A2. Arah Desain (R-37): DIISI OLEH PEMILIK, BUKAN OLEH AGENT
Agent tidak boleh mengarang isi bagian ini. Pemilik mengisi, atau menjawab pertanyaan agent lalu agent hanya mencatat jawabannya ke DESIGN.md.
Field
Diisi pemilik
Nama perusahaan & tagline
[ISI]
Kepribadian brand (3 kata sifat)
[ISI]
Audiens utama
[ISI]
Palet warna (2 sampai 3 warna inti + 1 aksen)
[ISI]
Tipografi (heading, body) beserta alasan pemilihan
[ISI]
Suasana (mood) dan referensi visual yang disukai (inspirasi, bukan untuk ditiru)
[ISI]
Identity motif (satu pola/gestur/suara tipografi yang berulang)
[ISI]
Dial
ENERGY [1-3] / RHYTHM [1-3] / MOTION [1-3]
Tema
Light saja / Dark saja / Toggle (sertakan alasan)
Aturan jika kosong: hasil wajib diberi label "draft without direction", memakai dial default ENERGY 1 / RHYTHM 1 / MOTION 1, dan bukan deliverable final.
Design Read (wajib ditulis agent satu baris sebelum membangun):
Reading this as: software house company profile untuk [audiens], bergaya [bahasa visual], dial [ENERGY/RHYTHM/MOTION].
Jika arah ambigu, agent mengajukan satu pertanyaan penentu saja (bukan daftar pertanyaan).
Tiga Dial
Dial
1 (Tenang)
2 (Seimbang)
3 (Berani)
ENERGY
Sangat bersih, tenang
Percaya diri, terukur
Ekspresif, agency-like
RHYTHM
Komposisi seragam, konsisten
Konsisten dengan beberapa jeda
Asimetris, komposisi bervariasi antar section
MOTION
Hanya state hover
Scroll-reveal, transisi
Koreografi, parallax, pin
Hasil harus konsisten dengan dial yang dinyatakan (RHYTHM 3 tetapi semua section seragam = gagal).
A3. Override: Bagian PRD yang Dikoreksi
Tabel ini menggantikan ketentuan lama di Bagian 1 sampai 17.
Ref PRD
Isi lama
Override antislop
Aturan
FR-H-01 CTA "Mulai Proyek"
CTA umum
CTA harus spesifik pada tindakan, misal "Kirim brief proyek", "Jadwalkan konsultasi 30 menit", "Lihat studi kasus [nama proyek]". Dilarang: Get Started, Learn More, Try Now, Explore, Discover, Mulai Sekarang, Pelajari Lebih Lanjut
R-15
FR-H-02 Strip logo klien
Carousel logo di bawah hero
Dihapus sebagai pola default. Logo klien hanya tampil di dalam studi kasus yang nyata dan berizin, bukan bar "Trusted By" tepat di bawah hero
R-05, R-38
FR-H-04 Angka pencapaian animasi
Proyek selesai, klien, dll.
Hanya tampil jika sumber data nyata dan terdokumentasi. Jika belum ada data, section tidak dibuat. Dilarang: "10K+ users", "99,9% uptime", "100+ proyek" tanpa bukti
R-17, R-36
FR-H-08 Testimoni
Carousel testimoni
Hanya testimoni nyata dengan izin tertulis. Dilarang avatar AI, nama/jabatan acak. Jika belum ada, section testimoni tidak dibuat
R-18
FR-W-04 Paket Starter/Growth/Enterprise
3 paket, tengah di-highlight
Dilarang 3 kolom otomatis dan badge "Paling Populer". Tampilkan struktur harga sesuai model bisnis nyata (misal tabel model kerja: Fixed Price, T&M, Dedicated Team, dengan kapan masing-masing cocok). Jika harga belum ditetapkan, tampilkan "Harga ditentukan setelah discovery" beserta cara kerjanya
R-05
FR-H-06 / Proses Kerja 6 tahap
Timeline ikon bulat bernomor
Dilarang pola "3 langkah ikon bulat + angka". Proses disajikan dengan komposisi yang mengikuti isi (misal deliverable nyata per tahap, durasi, siapa terlibat)
R-05
FR-G-02 Mega menu
Ikon + deskripsi
Boleh, hanya bila setiap item mengarah ke halaman yang sudah ada
R-24
FR-G-07 WhatsApp floating
Tombol melayang
Boleh jika tautan wa.me nyata, ukuran tap 44px, tidak menutupi konten/CTA di mobile
R-03, R-26
FR-G-05 Dark mode toggle
Toggle tema
Jika dikirim, kedua mode wajib berfungsi penuh (kontras, komponen, font)
R-21, R-34
FR-S-05 Kalkulator estimasi
Rentang biaya
Rentang angka harus berasal dari data harga nyata pemilik. Jika belum ada, tampilkan form brief tanpa angka. Label hasil sebagai "estimasi awal", bukan penawaran
R-17, R-36
FR-F-01 FAQ
Template umum
FAQ hanya berisi pertanyaan nyata yang ditanyakan calon klien software house (milik pemilik/tim sales). Dilarang pertanyaan template ("Apakah data saya aman?", "Bisakah berhenti kapan saja?"). Jika belum ada, tidak dibuat
R-28
Bagian 10.2 Visual
Glassmorphism, gradient, hero 3D, Lucide
Lihat A5 (batasan visual)
R-01, R-04, R-10, R-13, R-19
Bagian 11 tipografi
Plus Jakarta Sans / Sora / Space Grotesk / Inter
Daftar itu bukan default. Tipografi mengikuti DESIGN.md dan wajib disertai alasan karakter brand
R-06
Sertifikasi/penghargaan (FR-A-04)
Daftar badge
Hanya yang nyata dan dapat diverifikasi (nomor, penerbit, tautan). Dilarang "SOC 2", "ISO 27001", "enterprise-grade security" tanpa bukti
R-36
Bagian 13 konten studi kasus
"Hasil terukur"
Metrik wajib bersumber dari klien/data nyata. Jika tidak ada, tulis hasil kualitatif yang jujur, bukan angka karangan
R-17
A4. Kewajiban Liveliness (Menambah Kehidupan)
Menghapus slop saja menghasilkan desain steril. Agent wajib memenuhi:
• Satu focal point per layar: satu elemen yang jelas paling penting.
• Kontras hierarki: ukuran, bobot, dan warna dibedakan dengan sengaja.
• Whitespace struktural: ruang kosong memisahkan dan mengatur ritme, bukan sisa.
• Satu aksen yang disengaja: satu warna/gestur dipakai hemat pada momen kunci. Nol aksen = steril, aksen di mana-mana = slop.
• Identity motif: satu pola, gestur, atau suara tipografi yang spesifik dan berulang sehingga desain "milik" perusahaan ini.
• Variasi komposisi antar section sesuai dial RHYTHM. Dilarang pola seragam "judul tengah + subjudul + grid kartu identik" di setiap section, dan dilarang variasi yang hanya berupa ganti warna latar selang-seling.
A5. Aturan Visual (Purpose-Gate: teknik boleh, alasan wajib ditulis)
Area
Dilarang sebagai default tanpa tujuan
Batas dosis / ketentuan
Warna (R-01, R-29)
Gradient biru-ungu, biru-cyan, ungu-pink; palet pelangi; ungu-hitam; neon; orb radial; latar glow penuh halaman
Maksimal 2 sampai 3 warna inti + 1 aksen (netral tidak dihitung). Gradient hanya jika bagian dari brand atau memisahkan level hierarki, alasan ditulis
Glassmorphism (R-10)
Blur di navbar, kartu, modal, sidebar sekaligus
Maksimal 1 sampai 2 elemen
Glow (R-13)
Glow di kartu + tombol + badge + ikon + latar + border bersamaan
Hanya aksen fokus pada maksimal 1 sampai 2 elemen penting
Shadow (R-12)
Shadow besar di semua komponen
Hanya sebagai penanda elevasi, alasan ditulis
Border radius (R-11)
Semua elemen berbentuk pil
Radius konsisten dengan design system, variasi dipakai sengaja
Ikon (R-04)
Sparkle, bintang, magic, petir, diamond, robot, orb; ikon dari satu set perpustakaan hanya karena populer (gaya Lucide)
Ikon harus relevan dengan isi. Jika tidak ada yang tepat, tidak memakai ikon. Utamakan ikon/ilustrasi kustom yang konsisten dengan identitas
Latar (R-07)
Grid, blueprint, kertas grafik, dot pattern
Hanya jika mendukung identitas visual spesifik, alasan ditulis
Badge (R-09)
Kapsul "AI Powered", "Beta", "New", "Secure", "Fast"; pil kecil di atas H1 yang mengulang isi headline
Hanya untuk status/label yang fungsional
Panah tombol (R-08)
Panah → / ↗ di hampir semua tombol
Hanya jika punya tujuan visual yang jelas
Kartu fitur (R-14)
Semua kartu identik ukuran, ikon, padding, layout
Variasi mengikuti hierarki isi; tidak semua hal harus berupa kartu
Layout (R-05)
Bento grid default, terminal palsu sebagai hero, footer 4 kolom template, "How it works" 3 langkah bernomor, "Trusted by" bar
Struktur dibangun dari kebutuhan isi nyata
Animasi (R-19)
Fade-up + floating + scale + bounce di semua elemen
Setiap animasi punya tujuan UX yang ditulis dan sesuai dial MOTION. Wajib menghormati prefers-reduced-motion; gerak lebih dari 5 detik wajib punya kontrol jeda
Ilustrasi (R-22)
Undraw, Storyset, karakter 3D blob generik
Hanya yang punya hubungan langsung dengan produk. Jika tidak ada, gunakan screenshot nyata atau tanpa ilustrasi
Tipografi (R-06)
Heading monospace besar untuk estetika "terminal"; label huruf kapital dengan tracking ekstrem
Pilihan font wajib disertai alasan karakter brand
Dekorasi
Menumpuk tren (glass + mesh + glow + mono + grid + rounded)
Satu bahasa visual yang konsisten
Placeholder produk
Bar abu-abu "skeleton" sebagai tangkapan layar produk
Gunakan screenshot/mockup nyata dari proyek, atau tidak ada visual
Meniru produk lain (R-30)
Meniru Linear, Vercel, Stripe, Notion, Apple tanpa diminta
Referensi hanya inspirasi, bukan templat
A6. Aturan Copywriting
• R-02: karakter em dash dilarang di seluruh teks UI. Gunakan koma, titik, titik dua, atau tanda kurung.
• R-16: buzzword dilarang: AI Powered, Next Generation, Revolutionary, Seamless, Cutting Edge, Intelligent, Ultimate, Powerful, Effortless, dan padanan bahasa Indonesianya ("revolusioner", "canggih", "terdepan", "solusi terbaik", "mulus", "tanpa hambatan").
• Gunakan bahasa spesifik: sebut apa yang dibuat, untuk siapa, berapa lama, apa hasilnya. Tunjukkan bukti, bukan klaim.
• Nada: manusiawi dan natural, sesuai kepribadian brand di DESIGN.md.
• Setiap CTA menyebut tindakan dan hasilnya (lihat A3).
A7. Aturan Wajib Tanpa Pengecualian (Hard Gate)
Kode
Aturan
Penerapan di proyek ini
R-03
Responsif mobile sempurna
Tidak ada overflow horizontal; teks tidak keluar wadah; kartu tidak bertabrakan; navbar nyaman; tap target minimal 44px; spacing konsisten di semua breakpoint (360, 768, 1024, 1280, 1536)
R-17
Tidak ada angka tanpa sumber
Lihat A3 dan A9 (kolom source)
R-18
Tidak ada testimoni fiktif
Lihat A3 dan A9 (is_verified)
R-23
Jangan membuat aset tanpa instruksi
Logo, foto tim, avatar, statistik, nama pada testimoni, dan struktur navigasi harus dikonfirmasi pemilik. Jika tidak bisa bertanya: logo = nama perusahaan sebagai teks atau penanda [LOGO]; foto = avatar inisial atau bentuk geometris sederhana; statistik = tidak ditampilkan atau [REAL DATA]. Placeholder tidak boleh disamarkan sebagai final
R-24
Navigasi hanya ke tujuan nyata
Menu header/footer hanya memuat halaman yang sudah dibuat. Fitur belum siap = tidak masuk navbar, atau diberi label "Segera hadir"
R-25
Kontras WCAG AA
Teks normal minimal 4,5:1, teks besar (18px+) minimal 3:1, diuji di seluruh area yang dilalui teks (termasuk di atas gambar/gradient). Tidak ada teks abu-abu di atas abu-abu
R-26
Elemen interaktif harus berfungsi
Setiap tombol/tautan/form punya perilaku nyata (anchor ke section yang ada, modal yang bisa ditutup Escape, toggle state, mailto:/URL nyata, form yang mengirim dan menampilkan umpan balik). Elemen tanpa tujuan dihapus. Sementara: // TODO di kode + label "Segera hadir" yang terlihat
R-27
Tiga state UI
Setiap tampilan data punya empty state, loading state, error state (daftar portofolio, blog, lowongan, tabel admin, form, unggah file)
R-28
FAQ spesifik
Lihat A3
R-32
Aksesibilitas keyboard
Tab/Shift+Tab logis, Enter/Space mengaktifkan, Escape menutup dialog, indikator fokus terlihat jelas. Dilarang outline: none tanpa pengganti yang lebih baik
R-33
Dilarang patching lewat skrip
Fitur ditulis langsung di source. Tidak ada skrip .py/.js yang str.replace pada CSS/source
R-34
Setiap tema yang dikirim harus berfungsi
Jika ada toggle, kedua mode diverifikasi penuh
R-35
Verifikasi sebelum menyerahkan
Jalankan/build aplikasi, cek console tanpa error, klik semua elemen interaktif satu per satu, uji setiap tema dan breakpoint mobile, lalu laporkan hasil klik per elemen sebagai bukti (misal "Kirim brief: form kosong menampilkan validasi"). Jika tidak dapat dijalankan, nyatakan dan verifikasi lewat inspeksi kode
R-36
Tidak ada klaim fiktif
Tidak ada klaim keamanan, kepatuhan, performa, atau pelanggan tanpa bukti
R-37
Arah desain wajib ada
Lihat A2
R-38
Konten nyata atau placeholder jujur
Placeholder ditulis apa adanya: [REAL DATA], "Segera hadir". Section kosong lebih baik daripada section karangan
R-39
Semantik & afordans
cursor: pointer pada semua elemen interaktif aktif (di base CSS), cursor: not-allowed pada yang nonaktif; aksi = <button>, navigasi = <a href>; tidak ada div/span yang diklik; nama aksesibel untuk setiap kontrol (ikon-saja memakai aria-label, ikon diberi aria-hidden="true"); setiap gambar punya alt (kosong jika dekoratif); setiap field punya <label> terlihat; state hover/active/disabled berbeda dan tidak hanya mengandalkan warna; dokumen penuh memiliki <html lang>, <title> unik, landmark (header, nav, main, footer), satu h1, tanpa loncat level heading; dilarang user-scalable=no / maximum-scale=1
R-40
Mekanisme performa
Semua <img>, <video>, <iframe> punya width dan height (atau aspect-ratio); ruang untuk konten yang datang terlambat dicadangkan; gambar hero adalah <img> di HTML, tidak loading="lazy", dengan fetchpriority="high"; tidak ada skrip pihak ketiga yang memblokir render di <head>; dilarang melaporkan skor Lighthouse/Web Vitals yang tidak diukur (tulis "not measured")
Mengganti Target di PRD: target "Lighthouse mobile >= 90" pada Bagian 3 dan 16 adalah target pengukuran yang hanya boleh dilaporkan setelah diukur sungguhan. Agent tidak boleh mengklaim angkanya tanpa pengukuran.
A8. Aturan Kualitas (Quality Locks)
• R-20 Identitas visual: palet spesifik, tipografi beralasan, komposisi unik; hierarki jelas di setiap section.
• R-21 Tema: pilih berdasarkan brand dan audiens. Jika tidak ada alasan kuat untuk tema tunggal, bangun toggle light/dark yang berfungsi sekarang (bukan ditunda).
• R-29 Palet: maksimal 2 sampai 3 warna inti + 1 aksen.
• R-31 Setiap keputusan punya alasan: sebelum selesai, tulis alasan satu baris untuk warna, layout, tipografi, spacing, penggunaan kartu, dan ikon/ilustrasi. Alasan yang tidak bisa ditulis dalam satu baris berarti keputusan itu tidak valid.
• Craftsmanship C-1 sampai C-5: Intentionality, Functional Completeness, Content-Driven Composition (section hanya ada jika isi membutuhkannya), Resilience (state, tema, breakpoint, keyboard), Evidence Over Claims.
Penyesuaian struktur halaman: urutan section mengikuti alur cerita perusahaan, bukan urutan templat AI. Beranda tidak wajib memuat semua modul di FR-H-01 sampai FR-H-11. Modul yang datanya belum nyata (statistik, testimoni, logo klien, FAQ) dihilangkan, dan itu dianggap benar, bukan kekurangan.
A9. Penyesuaian ERD agar Antislop Tertanam di Data
Perubahan skema berikut menimpa definisi di Bagian E3 untuk menegakkan R-17, R-18, R-36, R-38.
A9.1 Kolom tambahan
Tabel
Kolom baru
Tipe
Fungsi
testimonials
is_verified
BOOLEAN DEFAULT false
Hanya yang true boleh tampil
testimonials
consent_document_media_id
UUID FK media_files, NULL
Bukti izin tertulis klien
testimonials
verification_note
TEXT
Cara testimoni diverifikasi
clients
logo_usage_consent
BOOLEAN DEFAULT false
Logo tampil hanya jika true
projects
content_status
ENUM(placeholder, draft, verified) DEFAULT placeholder
Hanya verified tampil di produksi
project_metrics
source_description
TEXT NOT NULL
Sumber angka (laporan klien, dashboard, dll.)
project_metrics
source_url
VARCHAR(500) NULL
Tautan bukti jika publik
project_metrics
is_verified
BOOLEAN DEFAULT false
Hanya yang true boleh tampil
awards
verification_url
VARCHAR(500) NULL
Tautan penerbit/nomor sertifikat
awards
credential_id
VARCHAR(150) NULL
Nomor sertifikat
awards
is_verified
BOOLEAN DEFAULT false
Hanya yang true boleh tampil
team_members
photo_is_real
BOOLEAN DEFAULT false
Foto asli anggota tim, bukan stok/AI
faqs
source_note
TEXT NULL
Asal pertanyaan (pertanyaan nyata dari calon klien)
menu_items
target_exists
BOOLEAN (dihitung/divalidasi)
Mencegah tautan ke halaman yang tidak ada (R-24)
A9.2 Tabel baru
company_stats (statistik perusahaan, hanya data nyata)
Kolom
Tipe
Constraint
id
UUID
PK
label
VARCHAR(100)
NOT NULL
value
VARCHAR(50)
NOT NULL
source_description
TEXT
NOT NULL
source_url
VARCHAR(500)
NULL
as_of_date
DATE
NOT NULL (tanggal data berlaku)
is_verified
BOOLEAN
DEFAULT false
is_published
BOOLEAN
DEFAULT false
Aturan: baris tampil di website hanya jika is_verified = true AND is_published = true. Jika tidak ada baris yang memenuhi, section statistik tidak dirender.
design_direction (arah desain dari pemilik, sumber kebenaran untuk agent)
Kolom
Tipe
Keterangan
id
UUID
PK
brand_name, tagline
VARCHAR
Dari pemilik
personality
JSONB
3 kata sifat
palette
JSONB
2 sampai 3 inti + 1 aksen
typography
JSONB
Font + alasan
identity_motif
TEXT
Pola yang berulang
energy, rhythm, motion
SMALLINT (1 sampai 3)
Tiga dial
theme_policy
ENUM(light, dark, toggle)

theme_reason
TEXT
Alasan wajib
status
ENUM(missing, draft_without_direction, approved)
missing berarti hasil berlabel draft
approved_by (FK users), approved_at


design_decisions (penegakan R-31, satu alasan per keputusan)
Kolom
Tipe
Keterangan
id
UUID
PK
area
ENUM(color, layout, typography, spacing, cards, icon, illustration, animation, gradient, shadow, other)

decision
VARCHAR(255)
Apa yang diputuskan
reason
VARCHAR(255)
Alasan satu baris, NOT NULL
rule_ref
VARCHAR(20)
Mis. R-01, R-19
created_by, created_at


delivery_gate_reports (bukti verifikasi R-35, wajib sebelum rilis)
Kolom
Tipe
Keterangan
id
UUID
PK
release_tag
VARCHAR(50)

block
ENUM(hard_gate, purpose_gate, liveliness, craftsmanship)

rule_ref
VARCHAR(20)
Mis. R-26
status
ENUM(pass, fail, not_applicable)

evidence
TEXT NOT NULL
Bukti konkret (hasil klik, hasil build)
measured_value
VARCHAR(100) NULL
Hanya diisi jika benar-benar diukur
checked_by, checked_at


A9.3 Aturan integritas tambahan
• Query publik untuk testimoni, metrik, penghargaan, dan statistik wajib menyaring is_verified = true.
• Proyek dengan content_status != 'verified' tidak muncul di produksi (boleh tampil di staging dengan label "Placeholder").
• Lead dengan consent_privacy = false ditolak di level validasi.
• Rilis produksi diblokir jika delivery_gate_reports untuk release_tag tersebut memuat satu pun status fail, atau jika design_direction.status = 'missing' tanpa label draft.
A9.4 Tambahan indeks
Tabel
Indeks
testimonials
(is_verified, is_published)
project_metrics
(project_id, is_verified)
company_stats
(is_verified, is_published)
delivery_gate_reports
(release_tag, status)
A10. Tambahan Kebutuhan Fungsional Admin (menimpa Bagian 8)
ID
Fitur
Keterangan
Aturan
FR-AD-18
Status verifikasi konten
Admin menandai testimoni, metrik, penghargaan, dan statistik sebagai terverifikasi beserta sumber/bukti. Konten belum terverifikasi tidak tampil di publik
R-17, R-18, R-36
FR-AD-19
Peringatan placeholder
Badge "Placeholder" di admin dan staging untuk konten belum final; pemblokiran publikasi produksi
R-23, R-38
FR-AD-20
Validator navigasi
Menu tidak dapat disimpan jika menaut ke halaman yang tidak ada atau belum terbit
R-24
FR-AD-21
Pemeriksa kontras
Peringatan saat pengguna memilih warna teks/latar dengan rasio di bawah 4,5:1 (3:1 untuk teks besar)
R-25
FR-AD-22
Wajib alt text
Unggah gambar tidak dapat dipublikasikan tanpa alt_text (atau tanda dekoratif)
R-39
FR-AD-23
Gerbang rilis
Halaman "Release Gate" menampilkan hasil Delivery Gate; tombol rilis nonaktif bila ada fail
R-35
FR-AD-24
Editor state
Konten empty/error state yang dapat diatur untuk daftar publik
R-27
A11. Delivery Gate (Wajib Dijalankan Sebelum Menyerahkan)
Agent wajib mengeluarkan laporan PASS/FAIL satu baris per butir, setiap PASS disertai bukti konkret. Jika ada satu FAIL, dilarang menyerahkan: perbaiki lalu jalankan ulang.
Blok 1: Hard Gate (semua jawaban harus TIDAK)
• Ada em dash di teks? (R-02)
• Ada overflow horizontal / teks keluar wadah / layout rusak di mobile? (R-03)
• Ada statistik tanpa sumber nyata? (R-17)
• Ada testimoni fiktif? (R-18)
• Ada aset (logo, avatar, foto, statistik, testimoni, struktur navigasi) dibuat tanpa instruksi dan tanpa placeholder jujur? (R-23)
• Ada tautan navbar ke halaman/section yang tidak ada? (R-24)
• Ada teks dengan kontras di bawah WCAG AA? (R-25)
• Ada tombol/dropdown/form yang tidak berfungsi tanpa // TODO dan label terlihat? (R-26)
• Ada tampilan data tanpa empty/loading/error state? (R-27)
• Ada FAQ generik? (R-28)
• Ada UI yang tidak bisa dioperasikan keyboard atau tanpa fokus terlihat? (R-32)
• Ada fitur yang ditambahkan lewat skrip patch source/CSS? (R-33)
• Ada mode tema yang rusak? (R-34)
• Diserahkan tanpa dijalankan dan tanpa daftar hasil klik? (R-35)
• Ada klaim keamanan/kepatuhan/performa/pelanggan tanpa bukti? (R-36)
• Dibangun tanpa arah desain dan tidak berlabel "draft without direction" dengan dial 1/1/1? (R-37)
• Ada konten realistis yang dikarang? (R-38)
• Ada kontrol tanpa cursor: pointer, tanpa elemen native, tanpa nama aksesibel, tanpa state hover/active/disabled; field tanpa label; gambar tanpa alt; gerak mengabaikan prefers-reduced-motion; ARIA yang bertentangan; dokumen tanpa lang/title/landmark; atau zoom diblokir? (R-39)
• Ada media tanpa dimensi, hero lazy-load atau tanpa fetchpriority="high", skrip pihak ketiga memblokir render, atau angka performa yang tidak diukur? (R-40)
Blok 2: Purpose-Gate (FAIL jika muncul sebagai default tanpa alasan tertulis)
Gradient/glow (R-01), ikon generik atau gaya satu perpustakaan (R-04), tipografi tanpa alasan atau mono/uppercase tracking ekstrem (R-06), latar grid/dot (R-07), panah di hampir semua tombol (R-08), badge kapsul tanpa fungsi (R-09), glassmorphism lebih dari 1 sampai 2 elemen (R-10), shadow di semua komponen (R-12), glow di semua elemen (R-13), kartu fitur identik (R-14), animasi templat atau bertentangan dengan dial MOTION (R-19), ilustrasi generik (R-22).
Blok 3: Liveliness (semua jawaban harus YA)
• Tiga dial (ENERGY/RHYTHM/MOTION) dinyatakan eksplisit?
• Hasil konsisten dengan dial yang diklaim?
• Ada satu focal point jelas per layar?
• Whitespace bersifat struktural?
• Ada satu aksen yang disengaja?
• Ada identity motif yang spesifik dan berulang?
• Design Read ditulis sebelum membangun?
Blok 4: Craftsmanship & Quality Locks (semua jawaban harus TIDAK)
• C-1: ada keputusan yang alasannya hanya "default AI"?
• C-2: ada elemen interaktif yang tidak melakukan apa pun tanpa label jelas?
• C-3: ada section yang hanya mengisi templat AI?
• C-4: UI rusak pada state/tema/breakpoint/tanpa mouse?
• C-5: ada testimoni/statistik/klaim yang dikarang?
• Layout mengikuti templat AI atau ritme bertentangan dengan dial RHYTHM? (R-05)
• Semua elemen berbentuk pil? (R-11)
• CTA masih generik? (R-15)
• Ada buzzword AI? (R-16)
• Terasa generik jika logo dan nama diganti? (R-20)
• Dark mode dipaksakan tanpa alasan, atau toggle wajib ditunda dengan alasan? (R-21)
• Palet melebihi 2 sampai 3 inti + 1 aksen? (R-29)
• Terlihat seperti klon produk populer? (R-30)
• Ada keputusan besar yang alasannya tidak bisa ditulis satu baris? (R-31)
A12. Master Prompt untuk AI Coding Agent (Salin dan Tempel)
Kamu akan membangun website company profile software house berdasarkan dokumen
PRD & ERD ini. Aturan eksekusi:

1. Baca LAMPIRAN A (Antislop Execution Spec) lebih dulu. Lampiran A menimpa
   bagian PRD/ERD yang bertentangan.
2. Mode antislop: DURING. Umumkan sekali di awal: "antislop active: during
   (session override)."
3. Muat arah desain dari DESIGN.md / tabel design_direction (bagian A2).
   Jika kosong, tanyakan ke pemilik atau beri label "draft without direction"
   dengan dial ENERGY 1 / RHYTHM 1 / MOTION 1. Jangan mengarang arah desain.
4. Tulis satu baris Design Read sebelum menulis kode.
5. Jangan membuat aset (logo, foto, avatar, statistik, testimoni, nama klien)
   tanpa instruksi. Gunakan placeholder jujur: [LOGO], avatar inisial,
   [REAL DATA].
6. Jangan membuat section yang datanya belum nyata (statistik, testimoni,
   logo klien, FAQ). Menghilangkannya sudah benar.
7. Bangun langsung di source. Dilarang skrip patch yang mengubah CSS/source
   dengan string replacement.
8. Setiap keputusan visual besar harus punya alasan satu baris. Catat ke
   design_decisions.
9. Implementasikan skema database dari Bagian E3 beserta penyesuaian A9
   (kolom verifikasi, company_stats, design_direction, design_decisions,
   delivery_gate_reports).
10. Terapkan tiga state (empty, loading, error) pada semua tampilan data.
11. Penuhi aksesibilitas dan performa (R-25, R-32, R-39, R-40). Jangan
    melaporkan skor yang tidak diukur; tulis "not measured".
12. Sebelum menyerahkan: jalankan atau build aplikasi, cek console, klik
    setiap elemen interaktif, uji tema dan breakpoint mobile, lalu keluarkan
    laporan Delivery Gate (A11) PASS/FAIL dengan bukti per butir. Jika ada FAIL,
    perbaiki dan jalankan ulang. Jangan serahkan hasil dengan FAIL.

Kerjakan per fase sesuai roadmap (Bagian 14), dimulai dari: struktur proyek,
skema database, design tokens dari DESIGN.md, lalu halaman publik, lalu admin.
A13. Checklist Serah Terima ke Pemilik
#
Item yang harus disiapkan pemilik sebelum agent mulai
Status
1
DESIGN.md terisi (A2): brand, palet, tipografi + alasan, motif, dial, tema
[ ]
2
Logo final atau konfirmasi memakai teks nama perusahaan
[ ]
3
Daftar layanan nyata yang ditawarkan
[ ]
4
Minimal satu studi kasus nyata berizin, atau keputusan menunda section portofolio
[ ]
5
Foto tim asli, atau keputusan memakai avatar inisial sementara
[ ]
6
Pertanyaan nyata dari calon klien untuk FAQ, atau keputusan menunda FAQ
[ ]
7
Struktur harga/model kerja yang akan ditampilkan
[ ]
8
Bukti untuk setiap angka/sertifikasi yang ingin dipajang
[ ]
9
Kebijakan privasi dan syarat layanan yang sudah ditinjau pihak berwenang
[ ]
10
Kontak resmi (email, WhatsApp, alamat) untuk form dan tombol kontak
[ ]
LAMPIRAN B: Arah Desain Pemilik (Mengisi A2)
Lampiran B mengisi tabel A2 dengan arah yang diberikan pemilik pada 3 November 2026. Isi yang belum diberikan pemilik tetap [ISI] dan tidak boleh dikarang agent (R-37). Jika ada selisih dengan tabel A2, Lampiran B yang berlaku.
B1. Arah yang Dicatat Apa Adanya
Kata kunci dari pemilik: modern, simpel, glass (kaca), arsitektur modern, hitam-merah, transparan.
Field A2
Isi
Sumber
Nama perusahaan & tagline
[ISI]
Belum diberikan
Kepribadian brand
Modern, simpel
Pemilik
Audiens utama
[ISI]
Belum diberikan
Palet
Hitam (inti), merah (aksen tunggal), putih/abu terang untuk teks (netral). Kode warna persis: [ISI]
Pemilik (kode warna belum)
Tipografi + alasan
[ISI]
Belum diberikan
Mood
Modern, simpel, terinspirasi arsitektur modern, permukaan transparan/kaca
Pemilik
Identity motif
[ISI]
Belum diberikan
Dial
ENERGY 2 / RHYTHM 2 / MOTION 2
Disimpulkan agent dari kata "modern, simpel"; pemilik boleh mengubah
Tema
Gelap tunggal (light mode tidak dikirim)
Alasan: identitas brand hitam-merah
Status design_direction: draft_without_direction sampai nama, audiens, tipografi, kode warna, dan identity motif terisi. Selama itu hasil build berlabel draft, bukan deliverable final.
Design Read:
Reading this as: company profile software house untuk [audiens belum ditentukan], bergaya modern minimalis berbahasa arsitektur kontemporer dengan permukaan kaca terbatas, palet hitam dan merah, dial ENERGY 2 / RHYTHM 2 / MOTION 2.
B2. Satu Hal yang Perlu Diputuskan Pemilik (Konflik R-10)
Permintaan "glass" dan "transparan" bertabrakan dengan R-10 (Glassmorphism) yang menetapkan glass hanya sebagai aksen, maksimal 1 sampai 2 elemen, dan melarang blur di navbar + kartu + modal + sidebar sekaligus. Ini bukan soal selera: glass di banyak permukaan merusak keterbacaan (R-25) dan membebani performa (R-40).
Opsi
Isi
Konsekuensi
1. Aksen terbatas (disarankan)
Kaca dipakai di maksimal 2 elemen kunci (misal navbar dan satu panel fokus di hero atau form kontak). Sisa antarmuka memakai permukaan hitam solid dengan transparansi halus pada border dan lapisan
Patuh R-10. Identitas "kaca" tetap terasa tetapi terbaca dan ringan
2. Karakter utama (override R-10)
Kaca menjadi bahasa visual di banyak elemen, dicatat sebagai override keputusan pemilik
Diizinkan jika pemilik memilihnya. Aturan lain tetap berlaku penuh: kontras diuji di seluruh area teks, ada fallback solid bila backdrop-filter tidak didukung, dan performa harus diukur
Status: menunggu jawaban pemilik. Sementara belum dijawab, berlaku Opsi 1.
B3. Panduan Eksekusi untuk Arah Ini
B3.1 Warna hitam dan merah (R-01, R-25, R-29)
• Struktur palet: hitam dan turunannya (hitam pekat, hitam lembut untuk permukaan berlapis) sebagai inti; putih/abu terang untuk teks; merah sebagai satu-satunya aksen.
• Merah dipakai hemat pada momen kunci: CTA utama, status aktif, satu elemen penanda identitas per layar. Merah di semua tempat (tombol, ikon, tautan, garis, badge) adalah slop.
• Dilarang: glow merah di sekitar elemen (R-13), gradient hitam-ke-merah memenuhi halaman (R-01), efek neon, dan bayangan merah sebagai dekorasi. Gradient hanya boleh jika alasan hierarkinya ditulis.
• Kontras merah di atas hitam wajib diuji: merah terang bisa lolos 4,5:1 di atas hitam, tetapi merah tua tidak lolos untuk teks kecil. Merah tua hanya untuk elemen non-teks.
• Teks putih di atas tombol merah harus diuji; banyak merah cerah gagal 4,5:1 untuk teks normal. Gunakan teks besar/tebal yang lolos 3:1 atau gelapkan merah sampai rasio terpenuhi.
B3.2 Glass dan transparansi (R-10, R-25, R-40)
• Teks di atas permukaan kaca diuji kontrasnya di seluruh area yang dilalui teks, termasuk saat latar di belakangnya berganti (gambar, gradient, scroll).
• Sediakan fallback solid (@supports not (backdrop-filter: blur(1px))) agar teks tetap terbaca.
• Blur diberi radius sedang dan dibatasi jumlahnya; backdrop-filter mahal di perangkat murah. Tidak ada klaim performa tanpa pengukuran.
• Transparansi di luar elemen kaca diwujudkan lewat lapisan hitam bertingkat dan border tipis semi-transparan, bukan blur tambahan.
• Kaca butuh sesuatu di belakangnya agar terlihat bermakna: tentukan elemen latar yang nyata (gambar, bentuk, atau foto proyek), bukan orb/blob generik (R-22).
B3.3 Modern dan simpel (R-05, R-20, C-3)
• Simpel berarti sedikit elemen dengan hierarki tegas, bukan kosong. Satu focal point per layar, whitespace struktural, satu aksen merah yang disengaja.
• Hindari kesan steril: kehidupan datang dari skala tipografi, kontras hitam-merah, komposisi, dan identity motif yang harus ditetapkan pemilik.
• Section dengan data belum nyata (statistik, testimoni, logo klien, FAQ) dihilangkan, sesuai A3.
B3.4 Terjemahan "arsitektur modern" (perlu persetujuan pemilik)
Ini tafsiran visual yang diusulkan, bukan keputusan. Pemilik menyetujui, mengubah, atau menolak:
• Komposisi terstruktur dengan garis dan bidang tegas, skala besar, ruang lapang, dan asimetri terkontrol (selaras dial RHYTHM 2).
• Sudut membulat kecil atau tajam yang konsisten (bukan pil; R-11).
• Foto proyek atau tekstur material (beton, kaca, logam) hanya jika berasal dari aset nyata pemilik (R-23). Tanpa aset, gunakan bentuk geometris sederhana, bukan ilustrasi stok.
• Waspada: garis-garis arsitektural tidak boleh menjadi latar grid/blueprint tanpa alasan (R-07). Jika ingin dijadikan identity motif, pemilik menyetujuinya dan alasannya ditulis.
B3.5 Gerak (dial MOTION 2, R-19)
• Transisi halus dan scroll-reveal terukur dengan tujuan UX yang ditulis. Tidak ada kombinasi fade-up + floating + scale + bounce di semua elemen.
• Hormati prefers-reduced-motion; gerak lebih dari 5 detik wajib punya kontrol jeda.
B3.6 Tema gelap tunggal (R-21, R-34)
• Tema gelap dipilih karena identitas brand hitam-merah (alasan tercatat), bukan karena "terlihat tech".
• Karena light mode tidak dikirim, toggle tema dihapus dari PRD (menimpa FR-G-05). Mode gelap wajib berfungsi penuh: kontras, komponen, formulir, state error/empty/loading, dan fokus keyboard yang terlihat jelas di latar hitam.
• Indikator fokus (R-32) harus kontras terhadap hitam dan terhadap merah.
B4. Pembaruan Catatan Keputusan (R-31)
Baris awal untuk tabel design_decisions:
Area
Keputusan
Alasan satu baris
Aturan
color
Inti hitam, aksen tunggal merah
Identitas brand yang diminta pemilik
R-01, R-29
theme
Gelap tunggal
Hitam adalah dasar identitas brand
R-21
glass
Aksen terbatas (sementara)
Menjaga keterbacaan dan performa sambil menyampaikan kesan kaca
R-10
layout
Komposisi bergaya arsitektur, RHYTHM 2
Kesan modern dan tertata sesuai arahan pemilik
R-05
gradient
Tidak dipakai kecuali beralasan hierarki
Mencegah gradient hitam-merah memenuhi halaman
R-01
B5. Yang Masih Dibutuhkan dari Pemilik
#
Kebutuhan
Status
1
Keputusan glass: Opsi 1 atau Opsi 2 (B2)
[ ]
2
Kode warna hitam, merah, dan netral
[ ]
3
Tipografi beserta alasan karakter brand
[ ]
4
Identity motif (satu pola/gestur yang berulang)
[ ]
5
Persetujuan tafsiran "arsitektur modern" (B3.4)
[ ]
6
Konfirmasi dial ENERGY 2 / RHYTHM 2 / MOTION 2
[ ]
7
Nama perusahaan, tagline, dan audiens utama
[ ]
LAMPIRAN C: Standar V2 Full-Stack (Revisi Mentor, Wajib)
Prioritas dokumen: Lampiran C menimpa seluruh bagian PRD dan ERD yang bertentangan, termasuk Lampiran A dan B untuk hal teknis. Aturan antislop (Lampiran A) dan arah desain (Lampiran B) tetap berlaku untuk tampilan dan konten.
Inti V2: website bukan landing page statis. Wajib ada dua sisi: landing page publik dan dashboard admin yang dilindungi login. Semua data di landing page diambil dari database dan dikelola lewat CRUD di dashboard, bukan hardcode di HTML.
C1. Perubahan Wajib terhadap Dokumen Sebelumnya
Ref
Ketentuan lama
Ketentuan V2 (berlaku)
FR-G-07
Tombol WhatsApp floating dengan pesan otomatis
DIHAPUS. Tidak ada alur order, booking, pendaftaran, atau pesan yang berakhir di WhatsApp. Kontak cepat diarahkan ke halaman /kontak di website
FR-K-05
Penjadwalan lewat Calendly/Cal.com/Google Calendar
DIGANTI form booking konsultasi di website yang tersimpan di database (C6)
Bagian 11
Beberapa alternatif stack (Next.js, Nuxt, Astro, Laravel, NestJS, dll.)
Pilih satu: Next.js 16 full-stack (App Router + Server Actions/Route Handlers). Alternatif lain dihapus dari dokumen ini
Bagian 11
Hosting Vercel atau VPS, database opsional
Deploy online dengan database production, link hidup (C8)
FR-AD-xx
CMS custom/Payload/Strapi sebagai opsi
Dashboard admin custom di dalam aplikasi yang sama (C5). CMS pihak ketiga tidak dipakai
Bagian 5.2
Out of scope: client portal
Tetap out of scope. Dashboard admin bukan client portal
Konten landing
Boleh statis
Semua konten dinamis dari database. Tidak ada teks layanan, testimoni, galeri, artikel, atau profil usaha yang ditulis langsung di HTML/JSX
FR-AD-01
Login + 2FA opsional
Login wajib. 2FA menjadi bonus (tidak dinilai wajib)
Roadmap Bagian 14
Frontend dahulu
Urutan kerja diganti (C9): database dan auth dahulu
C2. Stack Final (Pilih Satu: Next.js 16)
Lapisan
Keputusan
Framework
Next.js 16, App Router, TypeScript
Logika server
Server Actions untuk form dan mutasi; Route Handlers untuk endpoint yang butuh API (unggah file, webhook)
Database
PostgreSQL (disarankan, sesuai ERD). MySQL/SQLite hanya jika ERD disesuaikan; tipe JSONB, TSVECTOR, INET perlu diganti
ORM & migrasi
Prisma (schema = ERD Bagian E3 + C7). Migrasi tersimpan di repo
Validasi
Zod di server untuk semua input (juga dipakai di klien untuk umpan balik cepat)
Auth
Auth custom atau Auth.js (Credentials). Password di-hash (Argon2id atau bcrypt), session di cookie HttpOnly, Secure, SameSite=Lax
Proteksi route
middleware Next.js untuk /admin/* + pengecekan sesi ulang di setiap Server Action/Route Handler (middleware saja tidak cukup)
Penyimpanan file
Storage S3-compatible (Cloudflare R2, Supabase Storage, atau Vercel Blob). Jangan menyimpan unggahan di file system Vercel (sementara/ephemeral)
Email
Resend atau SMTP untuk notifikasi pesan/booking dan reset password
Anti-spam
Cloudflare Turnstile + honeypot + rate limit pada form publik dan login
Lokal
docker compose untuk PostgreSQL (dan MinIO jika memakai storage lokal)
Deploy
Vercel + PostgreSQL managed (Neon/Supabase), atau VPS dengan Docker Compose
C3. Peta Route
C3.1 Publik (landing)
Route
Sumber data
Keterangan
/
company_profile, services, projects, gallery_items, testimonials (approved), posts (published)
Hanya section yang punya data yang dirender (empty state jika kosong)
/layanan, /layanan/[slug]
services

/portofolio, /portofolio/[slug]
projects (verified)

/galeri
gallery_items

/blog, /blog/[slug]
posts (published)
Pengumuman memakai kategori khusus
/kontak
company_profile + form
Form tersimpan ke database
/mulai-proyek
form brief
Tersimpan ke leads + project_briefs
/booking
form booking konsultasi
Tersimpan ke consultation_bookings
/karier, /karier/[slug]
job_openings
Lamaran tersimpan ke job_applications
/faq
faqs
Hanya jika ada pertanyaan nyata (R-28)
C3.2 Admin (dilindungi login)
Route
Fungsi
/admin/login
Login (satu-satunya halaman admin tanpa sesi)
/admin
Ringkasan: pesan belum dibaca, booking menunggu, testimoni menunggu persetujuan, artikel draft
/admin/layanan
CRUD layanan
/admin/testimoni
CRUD + approve/hide
/admin/galeri
Unggah dan hapus foto
/admin/artikel
CRUD + draft/publish
/admin/pesan
Inbox pesan kontak
/admin/leads
Brief proyek
/admin/booking
Booking konsultasi
/admin/lowongan
Lowongan dan lamaran
/admin/portofolio
CRUD proyek
/admin/profil-usaha
Nama, tagline, jam operasional, sosial media
/admin/akun
Ganti password
Semua route admin yang diakses tanpa sesi dialihkan ke /admin/login. Navbar publik hanya memuat halaman yang sudah ada (R-24).
C4. Autentikasi & Keamanan (Wajib)
ID
Kebutuhan
AUTH-01
Password disimpan sebagai hash (Argon2id/bcrypt). Tidak pernah plaintext, tidak muncul di log, respons API, atau repo
AUTH-02
Login menghasilkan session/token. Cookie HttpOnly, Secure (production), SameSite=Lax, ada masa kedaluwarsa
AUTH-03
Semua route /admin/* dilindungi middleware, dan setiap Server Action/Route Handler admin memverifikasi sesi serta peran lagi di sisi server
AUTH-04
Logout menghapus sesi di server (sessions.revoked_at) dan cookie
AUTH-05
Rate limit login dan penguncian sementara setelah gagal berulang (failed_login_count, locked_until). Pesan error tidak membocorkan apakah email terdaftar
AUTH-06
Ganti password: wajib memasukkan password lama, password baru minimal 10 karakter dan dikonfirmasi, semua sesi lain dicabut setelah berhasil
AUTH-07
Admin pertama dibuat lewat skrip seed yang membaca kredensial dari environment variable. Dilarang menaruh password default di kode atau repo. Admin seed diwajibkan ganti password saat login pertama (must_change_password)
AUTH-08
Perlindungan CSRF (Server Actions bawaan Next.js memverifikasi origin; Route Handler yang mengubah data memeriksa token/origin)
AUTH-09
Hasil query ORM saja tidak dipercaya untuk otorisasi: setiap mutasi mengecek peran (admin, editor, dll.) dari sesi, bukan dari input klien
AUTH-10
Unggahan file divalidasi tipe (MIME + ekstensi + magic bytes), ukuran, dan nama file disanitasi
C5. Dashboard Admin: Matriks CRUD (Wajib)
Kolom "Tampil di landing" menunjukkan bahwa landing page harus membaca data ini dari database.
Modul
Create
Read
Update
Delete
Aturan khusus
Tampil di landing
Layanan
Ya
Ya (daftar + detail)
Ya
Ya (soft delete)
Urutan tampil, status terbit
Beranda, /layanan
Testimoni
Ya
Ya
Ya
Ya
Approve / hide (status pending, approved, hidden). Hanya approved dan terverifikasi tampil
Beranda
Galeri
Unggah
Ya
Edit judul/alt/urutan
Hapus (file ikut terhapus dari storage)
Alt text wajib, validasi tipe/ukuran
Beranda, /galeri
Artikel/pengumuman
Ya
Ya
Ya
Ya
Status draft / publish (publish menetapkan published_at)
Beranda, /blog
Inbox pesan
(dari form publik)
Ya
Ubah status baca + catatan tindak lanjut
Ya (arsip/hapus)
Status belum/sudah dibaca dan catatan tindak lanjut
Tidak
Booking konsultasi
(dari form publik)
Ya
Ubah status + catatan
Ya
Status pending, confirmed, done, cancelled
Tidak
Brief proyek / lead
(dari form publik)
Ya
Ubah status, assign, catatan
Ya
Sesuai FR-AD-09
Tidak
Lowongan & lamaran
Ya / (dari form)
Ya
Ya
Ya
Sesuai FR-AD-10
/karier
Portofolio
Ya
Ya
Ya
Ya
content_status = verified untuk tampil
Beranda, /portofolio
Profil usaha
(satu baris, di-seed)
Ya
Ya
Tidak
Nama, tagline, jam operasional, sosial media, kontak
Header, footer, /kontak, hero
Ganti password
Tidak
Tidak
Ya
Tidak
Lihat AUTH-06
Tidak
Aturan umum dashboard:
• Setiap form memvalidasi di server (Zod) dan menampilkan pesan error yang jelas per field dalam bahasa Indonesia (contoh: "Email tidak valid", "Judul wajib diisi", "Ukuran foto maksimal 5 MB").
• Aksi destruktif (hapus) meminta konfirmasi.
• Setiap tabel admin punya empty, loading, dan error state (R-27), pencarian/filter dasar, dan pagination.
• Setelah mutasi, halaman publik terkait diperbarui (revalidasi cache) sehingga perubahan terlihat tanpa deploy ulang.
• Semua tindakan penting tercatat di audit_logs.
C6. Alur Form: Semuanya Lewat Website dan Tersimpan di Database
Tidak ada alur yang berakhir di WhatsApp atau layanan eksternal tanpa penyimpanan di database.
Alur
Halaman
Validasi server
Tersimpan di
Notifikasi
Terlihat di admin
Pesan kontak
/kontak
Nama, email valid, pesan minimal 10 karakter, persetujuan privasi, Turnstile
leads + contact_messages
Email ke tim, konfirmasi ke pengirim
/admin/pesan (belum dibaca)
Brief proyek (setara "order")
/mulai-proyek
Jenis proyek, deskripsi, rentang anggaran/waktu, kontak, lampiran valid
leads + project_briefs + brief_attachments
Email ke sales + konfirmasi
/admin/leads
Booking konsultasi
/booking
Tanggal tidak di masa lalu, slot tersedia, kontak valid
consultation_bookings
Email konfirmasi
/admin/booking
Lamaran kerja (setara "pendaftaran")
/karier/[slug]
Data diri, CV PDF maks 5 MB, persetujuan privasi
job_applications
Konfirmasi ke pelamar
/admin/lowongan
Newsletter
footer
Email valid, double opt-in
newsletter_subscribers
Email konfirmasi
Daftar subscriber
Testimoni dari klien (opsional)
tautan khusus
Nama, isi, persetujuan
testimonials status pending
Email ke admin
/admin/testimoni (menunggu approve)
Setiap submit menampilkan umpan balik nyata (sukses atau error per field) dan mencegah submit ganda.
C7. Penyesuaian ERD
Perubahan berikut menimpa definisi di Bagian E3 dan A9.
C7.1 Kolom tambahan
Tabel
Kolom
Tipe
Fungsi
users
must_change_password
BOOLEAN DEFAULT true
Memaksa ganti password pada login pertama
users
password_changed_at
TIMESTAMPTZ NULL
Jejak ganti password
testimonials
status
ENUM(pending, approved, hidden) DEFAULT pending
Alur approve/hide
testimonials
submitted_via
ENUM(admin, public_form)
Asal data
testimonials
moderated_by, moderated_at
FK users, TIMESTAMPTZ
Siapa dan kapan menyetujui
contact_messages
read_status
ENUM(unread, read) DEFAULT unread
Status baca (menggantikan is_read)
contact_messages
read_at, read_by
TIMESTAMPTZ, FK users
Jejak pembacaan
contact_messages
follow_up_status
ENUM(none, in_progress, done) DEFAULT none
Progres tindak lanjut
contact_messages
follow_up_note
TEXT NULL
Catatan tindak lanjut admin
posts
status
Minimal draft dan published wajib; review, scheduled, archived opsional
Alur draft/publish
media_files
is_gallery
BOOLEAN DEFAULT false
Penanda foto galeri
C7.2 Tabel baru
company_profile (satu baris, dikelola di /admin/profil-usaha)
Kolom
Tipe
Keterangan
id
UUID
PK
company_name
VARCHAR(150)
NOT NULL
tagline
VARCHAR(255)

about_short
TEXT
Ringkasan untuk hero/footer
address
TEXT

phone, email_public
VARCHAR

operating_hours
JSONB
Per hari: {day, open, close, is_closed}
social_links
JSONB
{platform, url}[] (hanya yang nyata)
logo_media_id
UUID FK media_files NULL

updated_by, updated_at
FK users, TIMESTAMPTZ

gallery_items
Kolom
Tipe
Keterangan
id
UUID
PK
media_id
UUID FK media_files
NOT NULL
title
VARCHAR(150)

alt_text
VARCHAR(255)
NOT NULL (R-39)
caption
TEXT

sort_order
INT

is_published
BOOLEAN

created_by, created_at, updated_at


consultation_bookings
Kolom
Tipe
Keterangan
id
UUID
PK
lead_id
UUID FK leads
NOT NULL
preferred_date
DATE
NOT NULL
preferred_time_slot
VARCHAR(20)
Contoh 10:00-10:30
topic
VARCHAR(255)

notes
TEXT

status
ENUM(pending, confirmed, done, cancelled)
DEFAULT pending
admin_note
TEXT NULL

handled_by
UUID FK users NULL

created_at, updated_at


Constraint: UNIQUE (preferred_date, preferred_time_slot) untuk booking berstatus pending atau confirmed agar slot tidak ganda.
C7.3 Seed minimum
• 1 baris company_profile (nilai awal ditandai [ISI], bukan karangan).
• 1 admin dari environment variable (AUTH-07).
• Peran dan izin dasar (roles, permissions).
• Data contoh untuk pengembangan wajib berlabel placeholder (content_status = placeholder) dan tidak ikut ke produksi (R-38).
C8. Persyaratan Deploy & Repositori
Item
Ketentuan
Deploy
Online di Vercel atau VPS dengan database production (bukan SQLite lokal). Link hidup dan dapat diakses penilai
Database lokal
docker-compose.yml untuk PostgreSQL (dan MinIO jika perlu)
Repo
GitHub organisasi
README.md
Deskripsi proyek, tech stack, fitur, cara menjalankan lokal (langkah demi langkah), cara migrasi dan seed, daftar environment variable, tautan demo, kredensial demo yang aman atau cara membuatnya
Screenshot
Minimal: landing (desktop dan mobile) dan dashboard (daftar + form edit), tersimpan di repo (/docs/screenshots)
.env.example
Semua variabel dengan nilai kosong atau contoh palsu. Tidak ada kredensial asli. File .env masuk .gitignore
Contoh .env.example:
DATABASE_URL=postgresql://user:password@localhost:5432/company_profile
AUTH_SECRET=
ADMIN_SEED_EMAIL=
ADMIN_SEED_PASSWORD=
NEXT_PUBLIC_SITE_URL=http://localhost:3000
RESEND_API_KEY=
TURNSTILE_SITE_KEY=
TURNSTILE_SECRET_KEY=
S3_ENDPOINT=
S3_BUCKET=
S3_ACCESS_KEY_ID=
S3_SECRET_ACCESS_KEY=
Riwayat git harus bersih dari rahasia. Jika kredensial pernah ter-commit, kredensial itu dianggap bocor dan diganti, bukan sekadar dihapus dari file.
C9. Urutan Kerja (Menimpa Roadmap Bagian 14)
Tahap
Pekerjaan
Hasil yang bisa diperiksa
1
Desain database + migrasi (Prisma dari ERD + C7), docker compose, seed
Migrasi berjalan bersih di database kosong
2
Auth: login, session, middleware, logout, ganti password, seed admin
Route /admin tertolak tanpa login; password tersimpan sebagai hash
3
CRUD dashboard: profil usaha, layanan, galeri, artikel, testimoni, inbox pesan, lalu modul lain
Setiap modul bisa tambah/ubah/hapus dan validasi server menampilkan error jelas
4
Landing yang mengonsumsi database + form publik tersimpan ke DB
Mengubah data di dashboard mengubah tampilan landing
5
Polish UI sesuai Lampiran A dan B, aksesibilitas, responsif
Delivery Gate (A11) lulus
6
Deploy, README, screenshot, .env.example
Link hidup + repo lengkap
Mengerjakan landing lebih dulu dengan data hardcode lalu "menyambungkan database belakangan" tidak diizinkan, karena itu menghasilkan pekerjaan ulang dan melanggar standar V2.
C10. Acceptance Criteria V2 (Checklist Penilaian)
Arsitektur
[ ] Stack tunggal: Next.js 16 (App Router) full-stack.
[ ] Database PostgreSQL/MySQL/SQLite berjalan lokal via Docker Compose dan di production.
[ ] Dua sisi tersedia: landing publik dan dashboard admin.
Auth
[ ] Password ter-hash; tidak ada password plaintext di repo, log, atau database.
[ ] Dashboard hanya bisa dibuka setelah login; akses tanpa sesi dialihkan ke login.
[ ] Pemeriksaan sesi juga ada di Server Action/Route Handler, bukan hanya middleware.
[ ] Logout dan ganti password berfungsi.
CRUD nyata
[ ] Layanan: tambah, ubah, hapus, tampil di landing.
[ ] Testimoni: tambah, ubah, hapus, approve/hide; hanya yang approved tampil.
[ ] Galeri: unggah dan hapus foto; tampil di landing.
[ ] Artikel/pengumuman: CRUD dan status draft/publish; draft tidak tampil publik.
[ ] Profil usaha: nama, tagline, jam operasional, sosial media dapat diubah dan tampil di landing.
[ ] Tidak ada konten landing yang hardcode di HTML/JSX.
Alur lewat website
[ ] Tidak ada checkout/order/booking/pendaftaran/pesan yang berakhir di WhatsApp.
[ ] Form kontak tersimpan di database dan muncul di inbox admin dengan status belum/sudah dibaca dan catatan tindak lanjut.
[ ] Brief proyek, booking konsultasi, dan lamaran kerja tersimpan di database.
Validasi
[ ] Semua form divalidasi di server (bukan hanya di klien) dan menampilkan pesan error jelas.
[ ] Percobaan mengirim data tidak valid langsung ke endpoint (melewati UI) tetap ditolak.
Deliverable
[ ] Link deploy hidup dengan database production.
[ ] Repo GitHub organisasi + README.md.
[ ] Screenshot landing dan dashboard di repo.
[ ] .env.example tanpa kredensial asli; .env tidak ter-commit.
Antislop (tetap berlaku)
[ ] Delivery Gate Lampiran A11 lulus dan dilaporkan dengan bukti klik per elemen.
[ ] Tidak ada data karangan; placeholder berlabel jelas.
C11. Tambahan Master Prompt untuk AI Coding Agent
Tambahkan butir berikut ke Master Prompt (A12). Jika ada selisih, butir ini yang berlaku:
TAMBAHAN V2 (WAJIB, menimpa butir yang bertentangan):
- Stack: Next.js 16 full-stack (App Router + Server Actions/Route Handlers),
  PostgreSQL, Prisma, Zod. Jangan memilih stack lain.
- Urutan kerja: (1) skema DB + migrasi + docker compose + seed, (2) auth +
  middleware + ganti password, (3) CRUD dashboard, (4) landing yang membaca DB
  dan form publik yang menyimpan ke DB, (5) polish UI, (6) deploy + README +
  screenshot + .env.example. Jangan membuat landing hardcode terlebih dahulu.
- Dilarang membuat alur order/booking/pendaftaran/pesan yang berakhir di
  WhatsApp. Hapus tombol WhatsApp floating. Semua alur lewat website dan
  tersimpan di database.
- Semua konten landing dari database. Section tanpa data tidak dirender
  (empty state), jangan diisi data karangan.
- Password wajib di-hash. Jangan menaruh kredensial asli di repo. Admin awal
  dibuat lewat seed dari environment variable dan wajib ganti password.
- Validasi semua form di server dengan pesan error per field dalam bahasa
  Indonesia. Verifikasi sesi di setiap Server Action/Route Handler admin.
- Jangan menyimpan unggahan di file system server. Gunakan storage S3-compatible.
- Sebelum menyerahkan: jalankan migrasi dari database kosong, uji login,
  uji akses /admin tanpa sesi, uji tiap CRUD, uji tiap form publik sampai
  muncul di dashboard, lalu jalankan Delivery Gate (A11) dan laporkan hasil
  klik per elemen.