# Website Company Profile — PT. Central Saga Mandala

Website profil perusahaan resmi untuk **PT. Central Saga Mandala**, sebuah software house dan creative agency yang berkedudukan di Tabanan, Bali.

Sistem dibangun menggunakan arsitektur Laravel 12 modern dengan dua sisi:
1. **Landing Page Publik:** Semua konten bersumber dari database (profil, layanan, galeri portofolio, testimoni terverifikasi, artikel blog, dan formulir kontak interaktif).
2. **Admin Dashboard:** Autentikasi aman tanpa registrasi publik, rate limiting, proteksi `noindex`, dan manajemen konten penuh (CRUD 6 entitas, inbox pesan masuk, pembaruan profil usaha, serta ganti password).

---

## 1. Spesifikasi Teknis

- **Framework:** Laravel 12
- **Bahasa Pemrograman:** PHP 8.3+ (ekstensi: `pdo_sqlite` / `pdo_mysql`, `mbstring`, `openssl`, `curl`, `gd`)
- **Database:** SQLite (pengembangan lokal) / MySQL 8.4 (produksi)
- **Frontend & Styling:** Blade Templates, Tailwind CSS 4 (`@theme`), Vite 7
- **Tipografi:** *Instrument Serif* (Display/Heading) & *Geist* (Body text)
- **Pemrosesan Gambar:** Intervention Image v3 (`ImageManager` + GD driver, konversi otomatis ke WebP terkompresi)
- **Pengujian Otomatis:** Pest PHP 3 (37 feature tests mencakup seluruh alur bisnis)
- **Zona Waktu:** `Asia/Makassar` (WITA - Waktu Indonesia Tengah)

---

## 2. Persyaratan Sistem

- PHP >= 8.3
- Composer >= 2.6
- Node.js >= 20.x & npm >= 10.x
- SQLite 3 atau MySQL >= 8.0 / 8.4
- Ekstensi PHP: `ext-gd` (untuk manipulasi gambar di server produksi)

---

## 3. Panduan Instalasi Lokal

### Langkah 1: Kloning Repositori & Instal Dependensi
```bash
# Salin konfigurasi environment
cp .env.example .env

# Instal pustaka PHP
composer install

# Instal dependensi frontend
npm install
```

### Langkah 2: Konfigurasi Database & Kunci Aplikasi
Untuk pengembangan lokal menggunakan SQLite (standar):
```bash
# Buat berkas database SQLite jika belum ada
touch database/database.sqlite

# Generate kunci aplikasi
php artisan key:generate
```

### Langkah 3: Migrasi & Seeder Database
```bash
# Jalankan migrasi dan seeder akun admin serta profil perusahaan
php artisan migrate --seed

# (Opsional) Mengisi data contoh untuk demo layanan, artikel, dan testimoni:
php artisan db:seed --class=DemoSeeder
```

> **Akun Admin Standar:**
> - **Email:** `admin@example.com`
> - **Password:** nilai `ADMIN_PASSWORD` di berkas `.env` (default: `secret123`)
> - **Peringatan:** Pada server produksi (`APP_ENV=production`), password admin wajib diubah dan seeder akan menolak kata sandi lemah.

### Langkah 4: Tautan Berkas Publik & Kompilasi Asset
```bash
# Buat symlink dari storage ke public
php artisan storage:link

# Kompilasi asset dengan Vite
npm run build
```

### Langkah 5: Jalankan Server Pengembangan
```bash
# Jalankan server Laravel
php artisan serve
```
Akses aplikasi melalui peramban web:
- Halaman Publik: `http://localhost:8000`
- Dashboard Admin: `http://localhost:8000/login`

---

## 4. Menjalankan Pengujian Otomatis (Testing)

Proyek ini dilengkapi dengan 8 berkas Feature Test menggunakan **Pest 3** yang mencakup seluruh fungsionalitas inti:

```bash
# Jalankan seluruh rangkaian test
./vendor/bin/pest

# Jalankan test tertentu (contoh: Auth)
./vendor/bin/pest tests/Feature/AuthTest.php
```

Daftar cakupan pengujian:
1. `tests/Feature/AuthTest.php` — Proteksi tamu, login sukses/gagal, logout, dan rate limiting login (5 percobaan).
2. `tests/Feature/ContactTest.php` — Validasi formulir, bot honeypot, dan penyimpanan pesan kontak.
3. `tests/Feature/ServiceTest.php` — CRUD layanan, validasi keunikan slug, filter status aktif, dan respon 404.
4. `tests/Feature/GalleryTest.php` — Unggah gambar dan pembersihan berkas fisik saat data dihapus.
5. `tests/Feature/TestimonialTest.php` — Filter status pending/hidden pada homepage dan alur persetujuan admin.
6. `tests/Feature/ArticleTest.php` — Manajemen artikel, filter draft vs published, timestamp publikasi otomatis, dan respon 404 draf.
7. `tests/Feature/MessageTest.php` — Inbox pesan admin, penandaan status baca, penugasan `handled_by`, dan catatan internal.
8. `tests/Feature/PasswordTest.php` — Verifikasi password lama, validasi panjang minimal 8 karakter, konfirmasi kecocokan, dan penggantian password.

---

## 5. Menjalankan Database dengan Docker (Opsional)

Jika ingin menjalankan MySQL 8.4 menggunakan Docker Compose:
```bash
docker compose up -d
```
Pastikan variabel `DB_CONNECTION=mysql` dan port `3306` pada file `.env` telah disesuaikan dengan konfigurasi di `docker-compose.yml`.

---

## 6. Catatan Privasi & Keamanan Data (UU PDP)

- Data formulir kontak yang dikirim oleh publik disimpan dalam tabel `contact_messages`.
- Admin yang menangani pesan dicatat secara otomatis pada kolom `handled_by`.
- Akses ke menu pesan `/admin/pesan` dibatasi secara ketat hanya untuk admin yang terotentikasi.
- Header `X-Robots-Tag: noindex` dan meta tag `noindex, nofollow` aktif pada seluruh halaman admin untuk mencegah perayap mesin pencari mengindeks informasi sensitif.
- Seluruh pesan kontak yang tidak lagi diperlukan dapat dihapus secara permanen melalui tombol hapus pada panel admin.
