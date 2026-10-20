# PRD — Website Company Profile PT. Central Saga Mandala

- **Tanggal:** 2026-10-17
- **Stack:** Laravel 12 + PHP 8.3 + MySQL 8 + Blade + Tailwind CSS 4 + Vite + Intervention Image 3 + Pest 3
- **Filter Desain:** antislop, mode DURING
- **Status:** siap coding. Section 16 tidak memblokir. Dua item diisi kemudian lewat dashboard.

---

## 0. Profil Perusahaan

> **PT. Central Saga Mandala** (brand pendek: **Central Saga**)
> Software House & Creative Agency
> Berkedudukan di **Tabanan, Bali**. Klien lokal dan internasional.
> Memadukan seni desain dan rekayasa perangkat lunak.

**Aturan penulisan nama:**
- Legal name di `<title>`, footer, seeder `company_name`, halaman resmi: **PT. Central Saga Mandala**.
- Brand pendek di copy naratif, hero, artikel: **Central Saga**.
- Tidak menyingkat jadi "PT. CSM" di UI publik.
- Brand pendek tetap "Central Saga", bukan "Saga Mandala".

---

## 1. Ringkasan

Website company profile PT. Central Saga Mandala dengan dua sisi:

1. **Landing publik** untuk pengunjung, seluruh konten diambil dari database.
2. **Dashboard admin** (protected login) untuk mengelola seluruh konten tanpa menyentuh kode.

Semua alur data melalui website dan tersimpan di MySQL. Tidak ada checkout WhatsApp, tidak ada konten hardcode di Blade selain label UI dan halaman error 500 (lihat FR-L8).

---

## 2. Tujuan & Kriteria Sukses

| # | Tujuan | Kriteria Sukses |
|---|--------|-----------------|
| G1 | Landing menampilkan konten dinamis dari DB | Semua section dan `<title>` membaca tabel MySQL (bukan literal) |
| G2 | Admin kelola konten mandiri | 6 CRUD + inbox pesan + ganti password + edit profil usaha |
| G3 | Validasi server-side | Error Bahasa Indonesia per-field dengan nama field Bahasa Indonesia (array `attributes`) |
| G4 | Siap deploy | `.env.example`, README, migration, seeder, docker-compose, Pest test, HTTPS, backup |

---

## 3. Persona

| Persona | Kebutuhan Utama |
|---------|-----------------|
| **Calon klien** (pengunjung) | Lihat layanan, portofolio, testimoni, artikel, kirim pesan |
| **Admin** (tim PT. Central Saga Mandala) | Login aman, kelola konten, tindak lanjuti pesan, update profil usaha |

---

## 4. Ruang Lingkup

### 4.1 In-Scope (V1)

- Landing page publik: hero, layanan, galeri, testimoni (approved), artikel (published), form kontak, footer profil usaha.
- Halaman detail: `/layanan/{slug}`, `/artikel`, `/artikel/{slug}`, `/galeri`.
- Dashboard admin: login, dashboard ringkasan, CRUD 6 entitas, ganti password.
- Auth dibuat sendiri, bcrypt, session, middleware `auth`/`guest`, throttle login 5/menit.
- Validasi server-side FormRequest, error Bahasa Indonesia (`lang/id/validation.php` dengan `attributes`).
- Upload gambar dengan resize terpusat (`ImageUploader`, output WebP).
- SEO dasar: `<title>` dinamis per halaman, meta description, Open Graph, canonical.
- `X-Robots-Tag: noindex` via middleware untuk `/admin/*`, meta `noindex, nofollow` di view admin dan login.
- Halaman error 404 (bergaya situs) dan 500 (statis, tanpa DB, hanya tampil saat `APP_DEBUG=false`).
- Migration + seeder (dengan guard password) + `.env.example` + `docker-compose.yml`.
- Feature test dengan **Pest 3** (8 file) memakai database terpisah.

### 4.2 Out-of-Scope (V1)

- Multi-admin / role permission
- Register dan reset password publik
- Pembayaran online
- Upload video, upload SVG
- Multi-bahasa
- Notifikasi email otomatis
- Dark mode toggle
- Kategori artikel (V2)
- Cache dan queue (V1: `file` dan `sync`)

---

## 5. Arah Desain

### 5.1 Design Read

> Company profile Software House & Creative Agency berbasis di Bali, audiens pemilik bisnis dan startup, gaya visual "studio kreatif yang tenang", dial **ENERGY 2 / RHYTHM 2 / MOTION 2**.

### 5.2 Dial

| Dial | Nilai | Alasan |
|------|-------|--------|
| ENERGY | 2 | Agensi kreatif butuh kesan hidup, tetap profesional |
| RHYTHM | 2 | Portofolio, layanan, artikel butuh komposisi berbeda |
| MOTION | 2 | Hover + scroll reveal halus 200ms, hormati `prefers-reduced-motion` |

### 5.3 Identity Motif

Garis vertikal tipis di margin kiri setiap section + nomor section `01 / 02 / 03` (Instrument Serif, kecil, warna aksen). Diulang konsisten. Bukan badge, bukan pill.

### 5.4 Tipografi

| Peran | Font | Sumber | Alasan |
|-------|------|--------|--------|
| Display | **Instrument Serif** | Google Fonts | Editorial, memadukan seni dan teknologi |
| Body | **Geist** | Google Fonts / npm `geist` | Netral, modern, mudah dibaca |

**Dilarang:** Inter, Space Grotesk, Geist Mono sebagai display.

### 5.5 Palet (kontras terhitung)

| Token | Hex | Peran | Kontras | Status |
|-------|-----|-------|---------|--------|
| `--c-ink` | `#14201C` | Teks utama, background gelap | ±15:1 ke paper | Lulus |
| `--c-paper` | `#F5F1EA` | Background terang | — | — |
| `--c-accent` | `#A84E1C` | Teks aksen, tombol primer | 4,95:1 ke paper (teks); 5,57:1 teks putih di atasnya | Lulus AA |
| `--c-accent-2` | `#2F6B5C` | Tag/kategori (maks 1 per halaman) | 5,52:1 ke paper | Lulus |
| `--c-border` | `#DCD5C8` | Garis dekoratif (bukan input) | 1,3:1 ke paper | Dekorasi saja |
| `--c-field-border` | `#8A867B` | Border kolom input form | 3,23:1 ke paper, 3,64:1 ke putih | Lulus WCAG 1.4.11 |
| `--c-muted` | `#6B6A64` | Teks sekunder | 4,82:1 ke paper | Lulus |

**Aturan aksen:**
- `--c-accent` `#A84E1C` dipakai untuk: (a) teks aksen di atas paper (4,95:1), (b) latar tombol primer dengan teks putih (5,57:1).
- Tidak ada warna aksen tambahan **selain `--c-accent-2`** yang penggunaannya dibatasi maksimal 1 tempat per halaman.
- `--c-border` **tidak boleh** untuk border input. Input wajib `--c-field-border`.

**Dilarang:** ungu, gradient biru ke cyan, mesh gradient, neon, glow, glassmorphism, pill badge, emoji dekoratif.

### 5.6 Layout

- Grid 12 kolom, teks align kiri default.
- Hero: teks 7 kolom kiri + visual 5 kolom kanan.
- Layanan: list 2 kolom border tipis.
- Galeri: grid masonry ringan.
- Testimoni: kutipan besar serif.
- Artikel: 3 terbaru di home.
- Footer: 3 kolom.
- Tombol: radius 4px.

### 5.7 Aturan Copywriting

- **Dilarang:** em dash, "Get Started", "Learn More", "Explore", "Discover", "Unlock", "Elevate", "Seamless", "Revolutionary", "Next-Generation", "Cutting-Edge", "AI Powered", "Ultimate", "Powerful", "Effortless".
- **Tagline hero (final, dari klien):** "Membangun Impian Digital, Dari Bali ke Dunia"
- **Subheadline hero: USULAN, PERLU KONFIRMASI.** Draf: "Software house dan creative agency dari Tabanan, Bali. Kami memadukan desain dan rekayasa perangkat lunak untuk bisnis yang ingin tumbuh." **Tidak dipakai sampai klien setuju.** Dashboard sudah menyediakan form untuk mengisinya.
- **CTA spesifik:**
  - Hero: **"Diskusikan proyek Anda"** (scroll ke `#kontak`)
  - Layanan: **"Lihat detail layanan"**
  - Artikel: **"Baca artikel lengkap"**
  - Kontak: **"Kirim pesan"**
- **Layanan default (USULAN, PERLU KONFIRMASI):** Web Development, Mobile App Development, UI/UX Design, Branding & Identity, Digital Marketing. Hanya dipakai oleh `DemoSeeder` berlabel `[CONTOH]`.
- **Placeholder wajib berlabel:** `[FOTO TIM]`, `[FOTO PROYEK]`, `[LOGO]`, `[REAL DATA]`.

---

## 6. User Flow

### 6.1 Pengunjung

```
GET  /                       Home
GET  /layanan/{slug}         Detail layanan
GET  /galeri                 Galeri + lightbox
GET  /artikel                List artikel (paginate 10)
GET  /artikel/{slug}         Detail artikel
POST /kontak                 Submit kontak (throttle 5/menit + honeypot)
```

**Navbar (anchor absolut):**
- Home → `/`
- Layanan → `/#layanan`
- Galeri → `/galeri`
- Artikel → `/artikel`
- Kontak → `/#kontak`

**Home — jumlah item:**
- Layanan: semua `is_active = 1`.
- Galeri: **6 pertama** urut `sort_order ASC, id ASC`.
- Testimoni: 3 approved terbaru (`created_at DESC`).
- Artikel: 3 published terbaru (`published_at DESC`).

**CTA "Diskusikan proyek Anda"** → `/#kontak`.

### 6.2 Admin

```
GET  /login                  noindex, nofollow
POST /login                  throttle 5/menit
POST /logout
GET  /admin/*                X-Robots-Tag: noindex (middleware) + meta noindex
GET  /admin/layanan          /create /{id}/edit DELETE
GET  /admin/galeri           /create DELETE
GET  /admin/testimoni        /create /{id}/edit PATCH approve PATCH hide DELETE
GET  /admin/artikel          /create /{id}/edit DELETE
GET  /admin/pesan            /{id} PATCH read DELETE
GET  /admin/profil
GET  /admin/password
```

Middleware `auth` untuk `/admin/*`, `guest` untuk `/login`. Middleware kustom `NoIndexHeader` untuk `/admin/*`.

---

## 7. Kebutuhan Fungsional

### 7.1 Landing Publik

**FR-L1 Hero & Profil**
- Hero: `hero_title`, `hero_subtitle`, `hero_image` dari `site_profile`.
- Seeder `site_profile`:
  - `company_name`: "PT. Central Saga Mandala"
  - `tagline`: "Software House & Creative Agency"
  - `hero_title`: "Membangun Impian Digital, Dari Bali ke Dunia"
  - `hero_subtitle`: **NULL** (diisi admin lewat dashboard setelah klien konfirmasi)
  - `operating_hours`: **NULL** (diisi admin lewat dashboard setelah klien konfirmasi)
  - `address`: "Tabanan, Bali, Indonesia"
- Footer: `company_name`, `tagline`, `operating_hours`, `phone`, `email`, `address`, sosmed.
- Section disembunyikan jika field kosong. `hero_subtitle` null → tidak dirender.

**FR-L2 Layanan**
- Tampil `is_active = 1` urut `sort_order ASC, id ASC`.
- Judul, deskripsi (nl2br), gambar opsional.
- Klik judul → `/layanan/{slug}`.

**FR-L3 Galeri**
- Grid `gallery_items` urut `sort_order ASC, id ASC`. Home: `limit(6)`.
- Lightbox (Escape menutup).
- Empty state: "Belum ada foto portofolio."

**FR-L4 Testimoni**
- Hanya `status = 'approved'` urut `created_at DESC`. Home: `limit(3)`.
- Kosong → section disembunyikan.

**FR-L5 Artikel**
- List: `status = 'published'` urut `published_at DESC`, `paginate(10)`.
- Detail: 404 jika draft/tidak ada.
- Home: 3 published terbaru.

**FR-L6 Kontak**
- Wajib: `name`, `email`, `subject`, `message`. Opsional: `phone`. Honeypot: `website`.
- Validasi: name 3–100, email valid max 150, phone max 30, subject 5–200, message 10–2000, website max 0.
- Throttle: `throttle:5,1` di route.
- Sukses: simpan `status='unread'`, redirect + `session('success')`.
- Gagal: redirect + `$errors` + `old()`.

**FR-L7 SEO Dasar (dinamis, tanpa hardcode)**
- **Pemisah `<title>`:** karakter pipe dengan spasi di kiri-kanan (spasi, pipe, spasi). **Bukan em dash.**
- **Sumber nilai `{company_name}` dan `{tagline}`:** dari `SiteProfile::first()`. Fallback jika baris belum ada: `config('app.name')` untuk `{company_name}`, string kosong untuk `{tagline}` (jika kosong, ` | ` tidak dirender).
- Format per halaman:
  - Home: `{company_name} | {tagline}` (jika `tagline` null, hanya `{company_name}`).
  - Layanan detail: `{service.title} | {company_name}`.
  - Artikel list: `Artikel | {company_name}`.
  - Artikel detail: `{article.title} | {company_name}`.
  - Galeri: `Galeri | {company_name}`.
- Meta description:
  - Home: `tagline`.
  - Layanan: `service.description` dipotong 155 karakter.
  - Artikel detail: `article.excerpt`.
  - Lainnya: `tagline`.
- Open Graph:
  - `og:title` = `<title>` halaman.
  - `og:description` = meta description.
  - `og:type`: `website` (home, layanan, galeri, artikel list) atau `article` (artikel detail).
  - `og:url` = URL absolut halaman.
  - `og:image` = URL absolut (`asset('storage/' . $path)`), **hanya dirender jika gambar ada** (`hero_image` untuk home, `cover_image` untuk artikel detail, `image` untuk layanan detail). Jika tidak ada, **tag `og:image` tidak dirender sama sekali**, tidak diisi placeholder.
- `<link rel="canonical">` ke URL absolut halaman itu sendiri.
- Tidak ada meta keywords.

**FR-L8 Halaman Error**
- **404** (`resources/views/errors/404.blade.php`):
  - Boleh memakai layout publik (header + footer).
  - Isi: nomor section `04 / Tidak ditemukan`, headline "Halaman ini tidak ada.", teks "Coba kembali ke halaman utama.", tombol ke `/`.
- **500** (`resources/views/errors/500.blade.php`):
  - **Hanya tampil saat `APP_DEBUG=false`.** Jika `APP_DEBUG=true`, Laravel menampilkan halaman debug dan file ini tidak dipakai. Ini perilaku standar Laravel, bukan bug.
  - **Statis. Tidak memakai layout publik, tidak memanggil `site_profile`, tidak ada query DB, tidak ada komponen Blade yang memanggil model.**
  - Nama perusahaan ditulis langsung di HTML: `PT. Central Saga Mandala`. Ini satu-satunya hardcode nama perusahaan di luar seeder, karena halaman 500 harus tetap tampil saat DB mati.
  - Isi: "Terjadi kesalahan pada server.", "Silakan coba beberapa saat lagi.", tautan ke `/` (statis).
  - Tanpa stack trace.

**FR-L9 Robots**
- **`public/robots.txt`:** hanya berisi `Allow: /`. **Tidak boleh** menulis `Disallow: /admin` atau `Disallow: /login`, karena itu memberi tahu lokasi admin ke publik dan bertabrakan dengan meta `noindex` (crawler yang diblokir `robots.txt` tidak membaca `noindex`).
- Semua halaman `/admin/*` menambahkan **header `X-Robots-Tag: noindex`** lewat middleware `NoIndexHeader`. Ini yang mencegah indeks meski crawler tidak membaca meta.
- Halaman `/login` dan semua `/admin/*` menambahkan `<meta name="robots" content="noindex, nofollow">` di `<head>`.

### 7.2 Dashboard Admin

**FR-A1 Auth (dibuat sendiri)**
- `Auth::attempt` (bcrypt), throttle 5/menit per email+IP, regenerate session, logout invalidate.
- Tidak ada register/reset publik. Akun dari seeder (`ADMIN_EMAIL`, `ADMIN_PASSWORD`). Guard password seeder di Section 9.5.

**FR-A2 CRUD Layanan**
- Fields: `title` (req, max 150), `slug` (auto, unique, editable), `description` (req), `image` (nullable, jpg/png/webp, max 2MB), `is_active` (bool), `sort_order` (int, default 0).
- Tidak ada `icon`.
- Hapus: record + file. Ganti gambar: hapus file lama dulu.
- Slug unik: `unique:services,slug,{id}`.

**FR-A3 CRUD Galeri**
- Fields: `title` (nullable, max 150), `image` (req, jpg/png/webp, max 5MB), `sort_order` (int, default 0).
- Upload via `ImageUploader` (resize 1600px, WebP kualitas 82).
- Hapus: record + file.

**FR-A4 Testimoni**
- Fields: `name` (req, max 100), `role` (req, max 150), `message` (req, min 10), `rating` (req, int 1–5), `photo` (nullable, jpg/png/webp, max 2MB), `status` (pending/approved/hidden, default pending).
- Aksi list: Approve (PATCH), Hide (PATCH), Edit, Delete.
- `photo` lewat `ImageUploader` (resize 800px, WebP kualitas 85).

**FR-A5 Artikel**
- Fields: `title` (req, max 200), `slug` (auto, unique, editable), `excerpt` (req, max 500), `content` (req), `cover_image` (nullable, jpg/png/webp, max 3MB), `status` (draft/published, default draft), `published_at` (nullable).
- `author_id` = `auth()->id()` saat create.
- Draft→published dan `published_at` null: set `now()`.
- Published→draft: `published_at` dipertahankan.
- `cover_image` lewat `ImageUploader` (resize 1600px, WebP kualitas 82). Ganti: hapus lama.

**FR-A6 Inbox Pesan**
- List + filter (semua/unread/read).
- Detail: `admin_note` (textarea nullable) + PATCH read.
- `handled_by` = `auth()->id()` saat simpan note / tandai read.
- Hapus: DELETE.
- Buka detail tidak otomatis ubah status.

**FR-A7 Profil Usaha**
- Edit semua field `site_profile`.
- Validasi: `company_name` req max 150, `tagline` max 255, `hero_title` req max 255, `hero_subtitle` max 500, `hero_image` nullable image max 3MB, `operating_hours` nullable max 255, `phone` max 30, `email` email max 150, `address` nullable text, semua URL nullable max 255 `url`.
- `hero_image` lewat `ImageUploader` (resize 2000px, WebP kualitas 85). Ganti: hapus lama.
- Jika belum ada baris, form create.

**FR-A8 Ganti Password**
- `current_password` (req, `current_password`), `password` (req, `confirmed`, `min:8`).
- Sukses: `Hash::make`.

---

## 8. Kebutuhan Non-Fungsional

| Aspek | Standar | Catatan |
|-------|---------|---------|
| Stack | Laravel 12, PHP 8.3+, MySQL 8, Vite, Tailwind CSS 4, Intervention Image 3, Pest 3 | Section 8.1 |
| Auth | Dibuat sendiri, bcrypt, throttle 5/menit | FR-A1 |
| Validasi | FormRequest, `lang/id/validation.php` dengan array `attributes` | Section 8.3 |
| Upload | `storage/app/public`, `ImageUploader` terpusat, **output WebP** | Section 8.1 |
| DB | Migration + seeder (dengan guard password) | Section 9.5 |
| Timezone | `APP_TIMEZONE=Asia/Makassar` di `.env` **dan** `config/app.php` baca `env('APP_TIMEZONE', 'UTC')` | Cek Hari 1 |
| Cache | `CACHE_STORE=file` | Tabel `cache` dibuang |
| Queue | `QUEUE_CONNECTION=sync` | Tabel `jobs` dibuang |
| Session | `SESSION_DRIVER=database` | Tabel `sessions` dipertahankan |
| SEO | `<title>` dinamis dari `site_profile`, meta description, OG, canonical | FR-L7 |
| Robots | `X-Robots-Tag: noindex` via middleware untuk `/admin/*`; meta `noindex, nofollow` di admin & login; `robots.txt` hanya `Allow: /` | FR-L9 |
| Error pages | 404 bergaya situs, 500 statis tanpa DB (hanya saat `APP_DEBUG=false`) | FR-L8 |
| Deploy | **VPS**, Nginx + PHP-FPM, HTTPS Let's Encrypt, `php artisan optimize`, `SESSION_SECURE_COOKIE=true`, cron `mysqldump` harian | Roadmap Hari 10 |
| Keamanan | CSRF, `@csrf`, Blade escape, honeypot + throttle kontak | — |
| A11y | Kontras ≥ 4.5:1 (normal) / 3:1 (large), keyboard navigable, focus visible, `prefers-reduced-motion` | — |
| States | Empty/loading/error untuk list & form | Wajib |
| Mobile | 375 / 768 / 1024 / 1440px, tap target ≥ 44px, no horizontal scroll | Wajib |
| Performance | Lazy load, pagination artikel, resize upload, WebP | — |
| Tes | **Pest 3**, database terpisah (SQLite in-memory), `Storage::fake('public')`, ekstensi GD | Section 13.5 |

### 8.1 `ImageUploader` (Intervention Image **v3**, satu class, semua konteks)

**Aturan API (mengikat, ini API v3 bukan v2):**
- Pakai **`Intervention\Image\ImageManager`** dengan driver **GD**:
  ```php
  use Intervention\Image\ImageManager;
  use Intervention\Image\Drivers\Gd\Driver;
  $manager = new ImageManager(new Driver());
  $image = $manager->read($file->getRealPath()); // orientasi EXIF dibaca otomatis
  ```
- **Dilarang** memakai `Image::make()` (API v2) atau `->orientate()` (API v2). Orientasi EXIF sudah dibaca otomatis saat `read()`.
- Resize: **`$image->scaleDown(width: $maxDim, height: $maxDim)`** (tidak memperbesar gambar yang lebih kecil dari batas).
- Output: **`$image->toWebp(quality: $quality)`**, simpan bytes ke storage sebagai `.webp`.
- Validasi MIME upload: `mimes:jpg,jpeg,png,webp`. **Tolak SVG.**
- **Verifikasi nama method** (`read`, `scaleDown`, `toWebp`) dengan dokumentasi resmi `intervention/image` v3 saat install, karena ini API yang berubah antar versi.

| Konteks | Max dimensi (sisi terpanjang) | Kualitas WebP | Lokasi |
|---------|-------------------------------|----------------|--------|
| Layanan | 1200px | 85 | `storage/app/public/services/` |
| Galeri | 1600px | 82 | `storage/app/public/gallery/` |
| Testimoni | 800px | 85 | `storage/app/public/testimonials/` |
| Artikel cover | 1600px | 82 | `storage/app/public/articles/` |
| Hero (site_profile) | 2000px | 85 | `storage/app/public/profile/` |

Method: `ImageUploader::store(UploadedFile $file, string $folder, int $maxDim, int $quality): string` mengembalikan path relatif. Method `delete(?string $path): void`.

### 8.2 Terjemahan Validasi Bahasa Indonesia

Langkah wajib:
1. `php artisan lang:publish` untuk membuat folder `lang/en/`.
2. Salin `lang/en/validation.php` menjadi `lang/id/validation.php`.
3. Terjemahkan pesan umum (`required`, `email`, `min`, `max`, `unique`, `confirmed`, `image`, `mimes`, `current_password`) ke Bahasa Indonesia.
4. **Tambahkan array `attributes`** di `lang/id/validation.php`:

```php
'attributes' => [
    'name' => 'nama', 'email' => 'email', 'phone' => 'telepon',
    'subject' => 'subjek', 'message' => 'pesan', 'website' => 'website',
    'title' => 'judul', 'slug' => 'slug', 'description' => 'deskripsi',
    'image' => 'gambar', 'photo' => 'foto', 'role' => 'jabatan',
    'rating' => 'penilaian', 'status' => 'status', 'excerpt' => 'ringkasan',
    'content' => 'isi', 'cover_image' => 'gambar sampul',
    'published_at' => 'tanggal terbit', 'company_name' => 'nama perusahaan',
    'tagline' => 'tagline', 'hero_title' => 'judul hero',
    'hero_subtitle' => 'subjudul hero', 'hero_image' => 'gambar hero',
    'operating_hours' => 'jam operasional', 'address' => 'alamat',
    'facebook_url' => 'URL Facebook', 'instagram_url' => 'URL Instagram',
    'linkedin_url' => 'URL LinkedIn', 'maps_url' => 'URL Maps',
    'sort_order' => 'urutan', 'is_active' => 'status aktif',
    'admin_note' => 'catatan admin', 'current_password' => 'password saat ini',
    'password' => 'password',
],
```

Tanpa ini, G3 tidak terpenuhi.

### 8.3 Konfigurasi Tes

- `phpunit.xml` **wajib** menunjuk database terpisah:
  ```xml
  <env name="DB_CONNECTION" value="sqlite"/>
  <env name="DB_DATABASE" value=":memory:"/>
  ```
  atau database MySQL khusus `csm_profile_test`. **Tidak boleh** menunjuk ke `csm_profile` dev.
- Tes galeri dan upload memakai `Storage::fake('public')`.
- Ekstensi PHP `gd` wajib aktif (dipakai `ImageUploader`).
- `RefreshDatabase` dipakai, tapi hanya pada database test yang terpisah.

---

## 9. Struktur Data

| Tabel | Peran | Baris |
|-------|-------|-------|
| `users` | Auth + author + handler | 1+ |
| `sessions` | Session driver | 0..n |
| `site_profile` | Profil usaha | 1 |
| `services` | Layanan | 0..n |
| `gallery_items` | Galeri | 0..n |
| `testimonials` | Testimoni | 0..n |
| `articles` | Artikel | 0..n |
| `contact_messages` | Pesan | 0..n |

Tabel `cache` dan `jobs` dibuang.

### 9.1 Detail Kolom

**`users`**

| Kolom | Tipe | Constraint | Default |
|-------|------|-----------|---------|
| id | BIGINT UNSIGNED | PK, AI | — |
| name | VARCHAR(100) | NOT NULL | — |
| email | VARCHAR(150) | NOT NULL, UNIQUE | — |
| password | VARCHAR(255) | NOT NULL | — |
| remember_token | VARCHAR(100) | NULL | NULL |
| created_at | TIMESTAMP | NULL | NULL |
| updated_at | TIMESTAMP | NULL | NULL |

`email_verified_at` dibuang. Tabel `password_reset_tokens` dibuang. Tabel `sessions` dipertahankan.

**`sessions`** (bawaan): `id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`.

**`site_profile`** (tanpa `created_at`)

| Kolom | Tipe | Constraint | Default |
|-------|------|-----------|---------|
| id | BIGINT UNSIGNED | PK, AI | — |
| company_name | VARCHAR(150) | NOT NULL | — |
| tagline | VARCHAR(255) | NOT NULL | — |
| hero_title | VARCHAR(255) | NOT NULL | — |
| hero_subtitle | VARCHAR(500) | **NULL** | NULL |
| hero_image | VARCHAR(255) | NULL | NULL |
| operating_hours | VARCHAR(255) | **NULL** | NULL |
| phone | VARCHAR(30) | NULL | NULL |
| email | VARCHAR(150) | NULL | NULL |
| address | TEXT | NULL | NULL |
| facebook_url | VARCHAR(255) | NULL | NULL |
| instagram_url | VARCHAR(255) | NULL | NULL |
| linkedin_url | VARCHAR(255) | NULL | NULL |
| maps_url | VARCHAR(255) | NULL | NULL |
| updated_at | TIMESTAMP | NULL | NULL |

**`services`** (tanpa `icon`)

| Kolom | Tipe | Constraint | Default |
|-------|------|-----------|---------|
| id | BIGINT UNSIGNED | PK, AI | — |
| title | VARCHAR(150) | NOT NULL | — |
| slug | VARCHAR(180) | NOT NULL, UNIQUE | — |
| description | TEXT | NOT NULL | — |
| image | VARCHAR(255) | NULL | NULL |
| is_active | BOOLEAN | NOT NULL | 1 |
| sort_order | INT | NOT NULL | 0 |
| created_at | TIMESTAMP | NULL | NULL |
| updated_at | TIMESTAMP | NULL | NULL |

Index: `slug` (unique), `(is_active, sort_order)`.

**`gallery_items`** (tanpa `updated_at`)

| Kolom | Tipe | Constraint | Default |
|-------|------|-----------|---------|
| id | BIGINT UNSIGNED | PK, AI | — |
| title | VARCHAR(150) | NULL | NULL |
| image_path | VARCHAR(255) | NOT NULL | — |
| sort_order | INT | NOT NULL | 0 |
| created_at | TIMESTAMP | NULL | NULL |

Index: `sort_order`.

**`testimonials`**

| Kolom | Tipe | Constraint | Default |
|-------|------|-----------|---------|
| id | BIGINT UNSIGNED | PK, AI | — |
| name | VARCHAR(100) | NOT NULL | — |
| role | VARCHAR(150) | NOT NULL | — |
| message | TEXT | NOT NULL | — |
| rating | TINYINT UNSIGNED | NOT NULL | 5 |
| photo | VARCHAR(255) | NULL | NULL |
| status | ENUM('pending','approved','hidden') | NOT NULL | 'pending' |
| created_at | TIMESTAMP | NULL | NULL |
| updated_at | TIMESTAMP | NULL | NULL |

Index: `status`.

**`articles`**

| Kolom | Tipe | Constraint | Default |
|-------|------|-----------|---------|
| id | BIGINT UNSIGNED | PK, AI | — |
| author_id | BIGINT UNSIGNED | NULL, FK → users.id ON DELETE SET NULL | NULL |
| title | VARCHAR(200) | NOT NULL | — |
| slug | VARCHAR(220) | NOT NULL, UNIQUE | — |
| excerpt | VARCHAR(500) | NOT NULL | — |
| content | LONGTEXT | NOT NULL | — |
| cover_image | VARCHAR(255) | NULL | NULL |
| status | ENUM('draft','published') | NOT NULL | 'draft' |
| published_at | TIMESTAMP | NULL | NULL |
| created_at | TIMESTAMP | NULL | NULL |
| updated_at | TIMESTAMP | NULL | NULL |

Index: `slug` (unique), `(status, published_at)`, `author_id`.

**`contact_messages`**

| Kolom | Tipe | Constraint | Default |
|-------|------|-----------|---------|
| id | BIGINT UNSIGNED | PK, AI | — |
| handled_by | BIGINT UNSIGNED | NULL, FK → users.id ON DELETE SET NULL | NULL |
| name | VARCHAR(100) | NOT NULL | — |
| email | VARCHAR(150) | NOT NULL | — |
| phone | VARCHAR(30) | NULL | NULL |
| subject | VARCHAR(200) | NOT NULL | — |
| message | TEXT | NOT NULL | — |
| status | ENUM('unread','read') | NOT NULL | 'unread' |
| admin_note | TEXT | NULL | NULL |
| created_at | TIMESTAMP | NULL | NULL |
| updated_at | TIMESTAMP | NULL | NULL |

Index: `status`, `created_at`, `handled_by`.

### 9.2 Relasi

- `articles.author_id` → `users.id` (`ON DELETE SET NULL`)
- `contact_messages.handled_by` → `users.id` (`ON DELETE SET NULL`)

### 9.3 Model Eloquent (Wajib)

| Model | `$table` | `CREATED_AT` | `UPDATED_AT` |
|-------|----------|--------------|--------------|
| `User` | default | `'created_at'` | `'updated_at'` |
| `SiteProfile` | `'site_profile'` | `null` | `'updated_at'` |
| `Service` | default | `'created_at'` | `'updated_at'` |
| `GalleryItem` | default | `'created_at'` | `null` |
| `Testimonial` | default | `'created_at'` | `'updated_at'` |
| `Article` | default | `'created_at'` | `'updated_at'` |
| `ContactMessage` | default | `'created_at'` | `'updated_at'` |

### 9.4 Migration Order

1. `0001_01_01_000000_create_users_table.php` (dimodifikasi)
2. `create_site_profile_table.php`
3. `create_services_table.php`
4. `create_gallery_items_table.php`
5. `create_testimonials_table.php`
6. `create_articles_table.php` (FK → users)
7. `create_contact_messages_table.php` (FK → users)

### 9.5 Seeder (dengan guard password)

| Seeder | Isi | Idempotent |
|--------|-----|-----------|
| `AdminSeeder` | 1 user dari env, dengan guard di bawah | `firstOrCreate` by email |
| `SiteProfileSeeder` | 1 baris `site_profile` (`hero_subtitle`, `operating_hours` = NULL) | `firstOrCreate` by `company_name` |
| `DatabaseSeeder` | Panggil 2 seeder di atas | — |

**Guard wajib di `AdminSeeder`:**
- Jika `ADMIN_PASSWORD` kosong atau `strlen < 8`: **lempar `RuntimeException`** dan batalkan seeder, dengan pesan yang jelas: "ADMIN_PASSWORD wajib diisi dan minimal 8 karakter."
- Jika `APP_ENV=production` **dan** `ADMIN_PASSWORD` bernilai `password` atau `secret` (case-insensitive): **lempar `RuntimeException`** dan batalkan seeder.
- Seeder tidak boleh membuat user dengan password kosong dalam kondisi apa pun.

`DemoSeeder` (opsional, terpisah, **tidak** dipanggil default): 5 layanan usulan `[CONTOH]`, 2 artikel `[CONTOH]`, 1 testimoni approved `[CONTOH]`.

### 9.6 Query Pattern

| Kebutuhan | Query |
|-----------|-------|
| Home hero | `SiteProfile::first()` |
| Layanan publik | `Service::where('is_active',1)->orderBy('sort_order')->orderBy('id')->get()` |
| Galeri home | `GalleryItem::orderBy('sort_order')->orderBy('id')->limit(6)->get()` |
| Galeri page | `GalleryItem::orderBy('sort_order')->orderBy('id')->get()` |
| Testimoni home | `Testimonial::where('status','approved')->latest()->limit(3)->get()` |
| Artikel home | `Article::where('status','published')->orderByDesc('published_at')->limit(3)->get()` |
| Artikel list | `Article::where('status','published')->orderByDesc('published_at')->paginate(10)` |
| Artikel detail | `Article::where('slug',$slug)->where('status','published')->firstOrFail()` |
| Layanan detail | `Service::where('slug',$slug)->where('is_active',1)->firstOrFail()` |
| Dashboard count | `Service::count()`, `GalleryItem::count()`, `Testimonial::where('status','pending')->count()`, `Article::where('status','draft')->count()`, `ContactMessage::where('status','unread')->count()` |
| Inbox | `ContactMessage::where('status','unread')->latest()->paginate(15)` |

---

## 10. Struktur Folder

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/LoginController.php
│   │   ├── Public/{Home,Service,Gallery,Article,Contact}Controller.php
│   │   └── Admin/{Dashboard,Service,Gallery,Testimonial,Article,Message,Profile,Password}Controller.php
│   ├── Middleware/
│   │   └── NoIndexHeader.php   (X-Robots-Tag: noindex untuk /admin/*)
│   └── Requests/
│       ├── ContactRequest.php
│       ├── ServiceRequest.php
│       ├── GalleryRequest.php
│       ├── TestimonialRequest.php
│       ├── ArticleRequest.php
│       ├── ProfileRequest.php
│       └── PasswordRequest.php
├── Models/
│   ├── User.php
│   ├── SiteProfile.php
│   ├── Service.php
│   ├── GalleryItem.php
│   ├── Testimonial.php
│   ├── Article.php
│   └── ContactMessage.php
├── Services/
│   └── ImageUploader.php
database/
├── migrations/
└── seeders/{DatabaseSeeder,AdminSeeder,SiteProfileSeeder,DemoSeeder}.php
lang/
└── id/validation.php        (dari lang:publish + terjemahan + attributes)
public/
└── robots.txt               (hanya Allow: /)
resources/
├── css/app.css              (Tailwind 4 @theme)
├── js/app.js
└── views/
    ├── layouts/{public,admin}.blade.php
    ├── components/          (section-number, section-header, service-item, article-card, testimonial-quote, empty-state, form-error, seo-meta)
    ├── auth/login.blade.php (noindex)
    ├── errors/404.blade.php (layout publik)
    ├── errors/500.blade.php (STATIS, tanpa DB)
    ├── public/
    │   ├── home.blade.php
    │   ├── services/show.blade.php
    │   ├── galleries/index.blade.php
    │   ├── articles/{index,show}.blade.php
    └── admin/
        ├── dashboard.blade.php
        ├── services/{index,create,edit}.blade.php
        ├── gallery/{index,create}.blade.php
        ├── testimonials/{index,create,edit}.blade.php
        ├── articles/{index,create,edit}.blade.php
        ├── messages/{index,show}.blade.php
        ├── profile/edit.blade.php
        └── password/edit.blade.php
routes/web.php
tests/
└── Feature/
    ├── AuthTest.php
    ├── ContactTest.php
    ├── ServiceTest.php
    ├── GalleryTest.php
    ├── TestimonialTest.php
    ├── ArticleTest.php
    ├── MessageTest.php
    └── PasswordTest.php
phpunit.xml                  (DB test terpisah)
docker-compose.yml
.env.example
```

**Tailwind 4:** token warna dan font di `resources/css/app.css` dalam blok `@theme`. Tidak ada `tailwind.config.js`.

---

## 11. Aturan Anti-Slop (Mengikat)

### 11.1 Hard Gate

| Rule | Aturan |
|------|--------|
| R-02 | Tidak ada em dash di copy UI. `<title>` memakai karakter pipe dengan spasi (` \| `) sebagai pemisah, bukan em dash. |
| R-03 | Mobile 375px OK, tap target ≥ 44px |
| R-17 | Tidak ada angka tanpa sumber DB |
| R-18 | Tidak ada testimoni/avatar palsu |
| R-23 | Aset tanpa instruksi = placeholder berlabel |
| R-24 | Navbar hanya link yang ada route-nya, pakai anchor absolut |
| R-25 | Kontras ≥ 4.5:1 (normal) / 3:1 (large), input border ≥ 3:1 |
| R-26 | Setiap tombol/link punya aksi |
| R-27 | Empty/loading/error state |
| R-28 | FAQ hanya jika riil (V1: tidak ada) |
| R-32 | Keyboard navigable, focus visible |
| R-33 | Tidak ada patch CSS via script |
| R-34 | Light only |
| R-35 | Click-through sebelum demo |
| R-36 | Tidak ada klaim palsu |
| R-37 | Arah desain disetujui |
| R-38 | Konten fabricated dilarang |

### 11.2 Teknik yang Boleh dengan Alasan Tertulis

| Teknik | Syarat | V1 |
|--------|--------|-----|
| Gradient | Alasan tertulis | Tidak |
| Ikon | Relevan | Tidak |
| Grid/dot background | Alasan identitas | Tidak |
| Arrow tombol | Alasan navigasi | Tidak |
| Capsule badge | Status riil | Tidak |
| Glassmorphism | Maks 1-2 | Tidak |
| Shadow | Modal/dropdown | Terbatas |
| Glow | Maks 1-2 | Tidak |
| Card seragam | Alasan hierarki | Tidak |
| Animasi | Hover + reveal 200ms, `prefers-reduced-motion` | Ya |
| Ilustrasi | Relevan | Tidak |

### 11.3 Quality Locks

- **R-05 Layout:** dibangun dari kebutuhan konten (Section 5.6), bukan template Hero+3 cards, bukan "How It Works" 3 langkah, bukan "Trusted By" logo bar, bukan 4 kolom footer template. Section rhythm bervariasi (RHYTHM 2).
- **R-11 Border Radius:** semua elemen UI memakai radius 4px konsisten. Tidak ada pill.
- **R-15 CTA:** setiap CTA spesifik ke konteks (Section 5.7). Tidak boleh "Get Started", "Learn More", "Explore", "Discover".
- **R-16 Copywriting:** tidak ada buzzword AI (Section 5.7).
- **R-20 Visual Identity:** identitas dari motif nomor section (Section 5.3), palet 2 core + 1 accent + 1 accent-2 terbatas (Section 5.5), tipografi Section 5.4. Jika logo dan nama diganti, desain tetap terasa khas PT. Central Saga Mandala.
- **R-21 Dark Mode:** V1 hanya light mode (keputusan tertulis).
- **R-29 Color Palette:** maksimal 2 core + 1 accent + 1 accent-2 terbatas + netral. Tidak boleh ada warna tambahan tanpa alasan tertulis.
- **R-30 No Cloning:** tidak meniru Linear, Vercel, Stripe, Notion, atau produk populer lain secara keseluruhan.
- **R-31 Every Decision Has a Reason:** setiap keputusan visual punya alasan satu baris yang bisa ditulis.

---

## 12. Definition of Done

- [ ] Semua konten landing dari DB, termasuk `<title>` (tidak ada literal nama perusahaan di view, kecuali halaman 500)
- [ ] Login admin jalan, bcrypt, throttle, tanpa register/reset publik
- [ ] `AdminSeeder` menolak password kosong, < 8 karakter, dan `password`/`secret` saat production
- [ ] CRUD 6 entitas + validasi server-side dengan pesan Bahasa Indonesia
- [ ] Form kontak → `contact_messages` → tampil di `/admin/pesan`
- [ ] Honeypot + throttle 5/menit
- [ ] `ImageUploader` (Intervention Image **v3**, `ImageManager` + GD, `read`, `scaleDown`, `toWebp`) dipakai di 5 konteks, output WebP, tolak SVG, hapus file lama
- [ ] Slug unik
- [ ] Draft tidak tampil, testimoni non-approved tidak tampil, 404 untuk draft
- [ ] `author_id` dan `handled_by` terisi otomatis
- [ ] Empty state semua list
- [ ] SEO: `<title>` dinamis dari `site_profile` (fallback `config('app.name')`), meta description, OG dengan fallback `og:image`, canonical
- [ ] `/admin/*` mengirim `X-Robots-Tag: noindex` via middleware, meta `noindex, nofollow` di admin & login
- [ ] `robots.txt` hanya `Allow: /`
- [ ] Halaman 404 bergaya situs, halaman 500 statis tanpa DB (hanya tampil saat `APP_DEBUG=false`)
- [ ] Kontras AA lolos (WebAIM per pasangan)
- [ ] Keyboard navigable, focus visible, `prefers-reduced-motion`
- [ ] Mobile 375px OK
- [ ] **Pest 3 test PASS** (8 file), `phpunit.xml` menunjuk DB terpisah, `Storage::fake('public')`, GD aktif
- [ ] Deploy ke **VPS** dengan HTTPS, `php artisan optimize`, `SESSION_SECURE_COOKIE=true`, backup harian
- [ ] README + `.env.example` + `docker-compose.yml` + screenshot
- [ ] Delivery Gate PASS, termasuk uji manual halaman 500 dengan MySQL dimatikan

---

## 13. Delivery Gate

### 13.1 Block 1: Hard Gate

| Rule | Cek | Bukti |
|------|-----|-------|
| R-02 | Em dash | `grep -r "—" resources/views` kosong |
| R-03 | Mobile 375px | Screenshot 6 halaman |
| R-17 | Angka dari DB | Screenshot dashboard kosong |
| R-18 | Testimoni DB | Screenshot landing tanpa testimoni |
| R-23 | Placeholder | Screenshot hero `[FOTO TIM]` |
| R-24 | Nav absolut | Klik dari `/artikel` ke `/#layanan` jalan |
| R-25 | Kontras | WebAIM tiap pasangan Section 5.5 |
| R-26 | Tombol mati | Daftar click-through |
| R-27 | Empty state | Screenshot tiap list kosong + halaman 404 |
| R-32 | Keyboard | Tab sequence |
| R-34 | Light only | Tidak ada toggle |
| R-35 | Click-through | Daftar klik + console bersih |
| R-37 | Desain disetujui | Section 5 dikonfirmasi |
| R-38 | Placeholder | — |

### 13.2 Block 2: Purpose-Gate

- [ ] Semua teknik Section 11.2 yang dipakai punya alasan tertulis di kode
- [ ] Teknik yang tidak dipakai tidak muncul

### 13.3 Block 3: Design Direction Check

- [ ] Dial: ENERGY 2 / RHYTHM 2 / MOTION 2
- [ ] Satu focal point per screen
- [ ] Accent `#A84E1C` terbatas
- [ ] Motif nomor section konsisten
- [ ] Section rhythm sesuai RHYTHM 2

### 13.4 Block 4: Craftsmanship (dengan bukti)

| Kriteria | Bukti yang harus diisi |
|----------|------------------------|
| C-1 Intentionality | Daftar keputusan visual + alasan satu baris per keputusan |
| C-2 Functional Completeness | Daftar elemen interaktif + hasil klik |
| C-3 Content-Driven Composition | Daftar section + alasan kenapa ada |
| C-4 Resilience | Screenshot empty/loading/error + hasil tab sequence |
| C-5 Evidence Over Claims | Konfirmasi tidak ada testimoni/angka/klaim fabrikasi |
| R-05 | Screenshot tiap section, tunjukkan komposisi berbeda |
| R-11 | Screenshot tombol/input, tunjukkan radius 4px konsisten |
| R-15 | Daftar CTA + kesesuaian Section 5.7 |
| R-16 | `grep` buzzword di copy, kosong |
| R-20 | Screenshot landing, tunjukkan identitas khas |
| R-21 | Konfirmasi tidak ada toggle theme |
| R-29 | Daftar warna terpakai + jumlah |
| R-30 | Konfirmasi tidak clone produk lain |
| R-31 | Dokumen alasan tertulis untuk tiap keputusan visual |

### 13.5 Block 5: Automated Test (Pest 3)

`./vendor/bin/pest`. Semua PASS. **Database test terpisah** (Section 8.3). **`Storage::fake('public')`** untuk galeri. **GD aktif.**

| Test | Cakupan |
|------|---------|
| `AuthTest` | Guest `/admin` redirect `/login`; login benar/salah; logout; throttle 5x/menit |
| `ContactTest` | Submit valid → row; submit kosong → error; honeypot → ditolak; throttle |
| `ServiceTest` | CRUD; slug unik; ganti gambar hapus file lama |
| `GalleryTest` | Create menyimpan file; hapus record menghapus file fisik dari storage (`Storage::fake`) |
| `TestimonialTest` | Pending tidak tampil; hidden tidak tampil; approve membuat tampil |
| `ArticleTest` | CRUD; draft tidak tampil; published tampil; `published_at` auto; 404 draft |
| `MessageTest` | Unread tampil; PATCH read; `admin_note`; `handled_by` |
| `PasswordTest` | Password lama salah ditolak; password baru min 8; konfirmasi tidak cocok ditolak |

### 13.6 Block 6: Uji Manual Halaman 500

- [ ] Set `APP_DEBUG=false` di `.env` lokal
- [ ] Jalankan `docker compose stop mysql`
- [ ] Buka `/` di browser
- [ ] Halaman **statis** "Terjadi kesalahan pada server." tampil, tanpa layout publik, tanpa error PHP
- [ ] `docker compose start mysql` kembali normal
- [ ] Screenshot hasil dicatat di Gate

---

## 14. Roadmap 10 Hari

| Hari | Target |
|------|--------|
| 1 | Setup Laravel 12 + `docker-compose.yml` MySQL 8; migration (users dimodifikasi + 6 tabel); seeder admin (**dengan guard password**) + site_profile; `php artisan lang:publish` + terjemahkan `lang/id/validation.php` + `attributes`; `.env.example` final. **Cek timezone:** simpan satu baris `site_profile`, lihat `updated_at` di DB apakah WITA |
| 2 | `resources/css/app.css` Tailwind 4 `@theme`; `ImageUploader` (Intervention Image **v3**, verifikasi `read`/`scaleDown`/`toWebp` di dokumentasi resmi); LoginController + view; layout publik & admin; komponen `seo-meta`; middleware `NoIndexHeader`; `robots.txt` (`Allow: /` saja) |
| 3 | Home: hero, layanan, galeri (6 pertama), testimoni (3), artikel (3) + empty state + `<title>` dinamis + meta + OG (`og:image` fallback) |
| 4 | Form kontak + honeypot + throttle + simpan DB + flash |
| 5 | Layout dashboard + middleware + dashboard count + `noindex` (middleware + meta) |
| 6 | CRUD layanan + galeri (`ImageUploader`) |
| 7 | CRUD testimoni + approve/hide; CRUD artikel + draft/publish + author_id |
| 8 | Inbox (list + detail + read + note + handled_by + delete), profil usaha, ganti password; halaman 404 dan 500; **uji manual 500** (Section 13.6) |
| 9 | Pest test 8 file (Section 8.3: DB terpisah, `Storage::fake`) + polish anti-slop + Delivery Gate |
| 10 | Deploy **VPS**: Nginx + PHP-FPM, HTTPS Let's Encrypt, `php artisan optimize`, `storage:link`, `SESSION_SECURE_COOKIE=true`, cron `mysqldump` harian, README + screenshot + isi Gate |

---

## 15. Environment Variables

### 15.1 `.env.example` (dev)

```
APP_NAME="PT. Central Saga Mandala"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_TIMEZONE=Asia/Makassar

APP_LOCALE=id
APP_FALLBACK_LOCALE=en

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=csm_profile
DB_USERNAME=csm
DB_PASSWORD=secret

SESSION_DRIVER=database
CACHE_STORE=file
QUEUE_CONNECTION=sync

ADMIN_NAME="Administrator"
ADMIN_EMAIL=admin@example.com
ADMIN_PASSWORD=
```

### 15.2 Override Production

```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domainkamu.com
APP_TIMEZONE=Asia/Makassar
SESSION_DRIVER=database
SESSION_SECURE_COOKIE=true
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

### 15.3 `docker-compose.yml` (**hanya untuk dev**)

Password `secret` dan `rootsecret` **hanya untuk lokal**.

```yaml
services:
  mysql:
    image: mysql:8.4
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: csm_profile
      MYSQL_USER: csm
      MYSQL_PASSWORD: secret
      MYSQL_ROOT_PASSWORD: rootsecret
    ports:
      - "3306:3306"
    volumes:
      - mysql_data:/var/lib/mysql

volumes:
  mysql_data:
```

### 15.4 `phpunit.xml` (wajib, DB test terpisah)

```xml
<php>
    <env name="APP_ENV" value="testing"/>
    <env name="DB_CONNECTION" value="sqlite"/>
    <env name="DB_DATABASE" value=":memory:"/>
    <env name="CACHE_STORE" value="array"/>
    <env name="SESSION_DRIVER" value="array"/>
    <env name="QUEUE_CONNECTION" value="sync"/>
</php>
```

Jangan menunjuk ke `csm_profile` dev.

---

## 16. Konfirmasi Aset

Status: **tidak memblokir coding**. Item yang belum dikonfirmasi diisi kemudian lewat dashboard.

| Aset | Status | Usulan | Sumber |
|------|--------|--------|--------|
| Jam operasional | Belum dikonfirmasi | "Senin - Jumat, 09.00 - 18.00 WITA" | Usulan, belum dari klien |
| Subheadline hero | Belum dikonfirmasi | "Software house dan creative agency dari Tabanan, Bali. Kami memadukan desain dan rekayasa perangkat lunak untuk bisnis yang ingin tumbuh." | Usulan, belum dari klien |
| Data layanan | Belum dikonfirmasi | 5 layanan `[CONTOH]` di `DemoSeeder` | Usulan, belum dari klien |

| Aset | Nilai | Sumber |
|------|-------|--------|
| Nama perusahaan | PT. Central Saga Mandala | Klien (final) |
| Tagline | "Membangun Impian Digital, Dari Bali ke Dunia" | Klien (final) |
| Alamat | Tabanan, Bali, Indonesia | Klien (dari brief) |
| Logo | `[LOGO]` (teks nama perusahaan) | Belum ada, placeholder |
| Foto tim | `[FOTO TIM]` | Belum ada, placeholder |
| Foto proyek unggulan | `[FOTO PROYEK]` | Belum ada, placeholder |
| Foto galeri | kosong, empty state | Belum ada |
| Foto testimoni | kosong, inisial teks | Belum ada |
| Data testimoni | kosong, section hidden | Belum ada |
| Sosmed resmi | kosong | Belum ada |
| Telepon & email resmi | kosong | Belum ada |

`hero_subtitle` dan `operating_hours` **tetap NULL** di seeder dan section disembunyikan sampai admin mengisinya lewat `/admin/profil`.
