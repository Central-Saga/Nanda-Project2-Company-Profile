# Analisis Proyek Company Profile Software House (V2 Full-Stack)

## 1. Tujuan Produk & Dua Sisi Aplikasi
Website company profile software house berfungsi sebagai etalase digital dan mesin perolehan prospek (lead generation) tanpa mengandalkan WhatsApp. Aplikasi terdiri atas dua sisi yang terintegrasi:
- **Landing Publik**: Etalase kredibilitas, layanan, studi kasus, artikel, dan kanal interaksi (kontak, brief proyek, booking konsultasi, lamaran karier, newsletter). Semua konten ditarik dari database; section tanpa data terverifikasi dirender sebagai empty state.
- **Dashboard Admin**: Pengelolaan data tersentralisasi (CRUD layanan, portofolio, artikel, galeri, profil usaha, moderasi testimoni, manajemen inbox pesan, lead brief, booking konsultasi, lowongan/lamaran, audit log, dan ganti kredensial).

## 2. Stack Final, Rute & Skema Data
- **Stack Final**: Next.js 16 (App Router, TypeScript), Server Actions (form/mutasi), Route Handlers (media/webhook), PostgreSQL, Prisma ORM, Zod validation, Hash Argon2id/bcrypt, Cookie HttpOnly/SameSite=Lax, S3-compatible storage.
- **Rute Publik**: `/` (Beranda dinamis), `/layanan`, `/layanan/[slug]`, `/portofolio`, `/portofolio/[slug]`, `/galeri`, `/blog`, `/blog/[slug]`, `/kontak`, `/mulai-proyek`, `/booking`, `/karier`, `/karier/[slug]`, `/faq`.
- **Rute Admin**: `/admin/login`, `/admin` (dashboard utama), `/admin/layanan`, `/admin/testimoni`, `/admin/galeri`, `/admin/artikel`, `/admin/pesan`, `/admin/leads`, `/admin/booking`, `/admin/lowongan`, `/admin/portofolio`, `/admin/profil-usaha`, `/admin/akun`.
- **Daftar Tabel Akhir**:
  - *Akses & Keamanan*: `users` (tambah `must_change_password`, `password_changed_at`), `roles`, `permissions`, `role_permissions`, `sessions`, `audit_logs`.
  - *Konten Inti*: `company_profile` (C7.2), `pages`, `page_translations`, `services`, `service_translations`, `industries`, `industry_translations`, `technologies`, `projects` (tambah `content_status`), `project_translations`, `project_services`, `project_technologies`, `project_media`, `project_metrics` (tambah `is_verified`, `source`), `clients`, `testimonials` (tambah `is_verified`, `consent_document_media_id`, `status`, `submitted_via`, `moderated_by`, `moderated_at`), `team_members` (tambah `is_real_person`, `consent_media_id`), `team_translations`, `awards`, `faqs` (tambah `source_note`), `faq_translations`.
  - *Blog*: `posts` (status: minimal draft/published), `post_translations`, `post_categories`, `tags`, `post_tags`.
  - *Lead & Komunikasi*: `leads`, `contact_messages` (tambah `read_status`, `read_at`, `read_by`, `follow_up_status`, `follow_up_note`), `project_briefs`, `brief_attachments`, `consultation_bookings` (C7.2), `lead_notes`, `lead_status_history`, `newsletter_subscribers`.
  - *Karier*: `job_openings`, `job_translations`, `job_applications`, `application_status_history`.
  - *Sistem & Aset*: `media_files` (tambah `is_gallery`), `gallery_items` (C7.2), `site_settings`, `seo_metadata`, `redirects`, `menu_items` (tambah `target_exists`), `cookie_consents`.
  - *Antislop & Quality*: `company_stats` (A9.2), `design_direction` (A9.2), `design_decisions` (A9.2), `delivery_gate_reports` (A9.2).

## 3. Resolusi Konflik Dokumen (Prioritas: Lampiran C > B > A > Dasar)
1. **Opsi Stack**: Lampiran C membatalkan opsi Nuxt/Astro/Laravel di Bagian 11; mengunci Next.js 16 + PostgreSQL + Prisma.
2. **Kanal Interaksi WhatsApp**: Lampiran C menghapus tombol WhatsApp mengambang (FR-G-07) dan booking Calendly (FR-K-05); semua alur dialihkan ke database internal via `/kontak`, `/mulai-proyek`, dan `/booking`.
3. **Glassmorphism**: Lampiran B2 menyelesaikan benturan antara permintaan pemilik dan R-10 via Opsi 1 (aksen terbatas pada maksimal 2 elemen: navbar dan panel fokus, sisa antarmuka permukaan solid/transparansi batas).
4. **Tema & Toggle**: FR-G-05 (toggle tema) ditimpa Lampiran B3.6; aplikasi menerapkan tema gelap tunggal (dark mode only).
5. **Konten Landing**: Izin konten statis pada PRD lama ditimpa Lampiran C & A; seluruh section wajib dari database, tidak ada hardcode.

## 4. Item Menunggu Pemilik ([ISI])
- Nama perusahaan, tagline, dan target audiens utama.
- Nilai heksadesimal persis palet warna (hitam inti, merah aksen tunggal, netral teks).
- Pemilihan tipografi resmi (heading & body) serta alasan karakter brand.
- Identity motif (pola/gestur visual berulang).
- Konfirmasi final Glassmorphism (Opsi 1 vs Opsi 2) dan dial ENERGY 2 / RHYTHM 2 / MOTION 2.
- Aset resmi: logo vektor, foto tim, foto studi kasus, surat persetujuan testimoni.

## 5. Asumsi yang Diambil
- Mode status desain ditetapkan sebagai `draft_without_direction` dengan placeholder netral `[NamaPerusahaan]` dan `[LOGO]`.
- Dial visual mengacu pada B1: ENERGY 2 / RHYTHM 2 / MOTION 2.
- Kaca menerapkan Opsi 1 (aksen terbatas navbar + form panel) dengan solid fallback sesuai WCAG AA.
- Nilai warna aksen mengadopsi merah kontras tinggi (`#DC2626` / `#EF4444`) di atas latar hitam pekat (`#0A0A0A` / `#121212`) yang lolos rasio kontras 4,5:1.
