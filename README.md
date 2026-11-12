<p align="center">
  <img src="docs/screenshot/01-home.png" alt="PT Rekasaya Digital International — Company Profile" width="720" />
</p>

<h1 align="center">PT Rekasaya Digital International — Company Profile</h1>

<p align="center">
  <strong>Full-Stack Enterprise Company Profile & Content Management System</strong>
</p>

<p align="center">
  <a href="https://pt-region-companyprofile-project2-nda.netlify.app">🌐 Live Demo</a> •
  <a href="#screenshots">📸 Screenshots</a> •
  <a href="#tech-stack">🛠 Tech Stack</a> •
  <a href="#fitur">✨ Fitur</a> •
  <a href="#getting-started">🚀 Getting Started</a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Next.js-16.4-black?logo=next.js" alt="Next.js" />
  <img src="https://img.shields.io/badge/React-19.3-61dafb?logo=react" alt="React" />
  <img src="https://img.shields.io/badge/TypeScript-5-3178c6?logo=typescript" alt="TypeScript" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-4-06b6d4?logo=tailwindcss" alt="Tailwind CSS" />
  <img src="https://img.shields.io/badge/Prisma-7-2d3748?logo=prisma" alt="Prisma" />
  <img src="https://img.shields.io/badge/PostgreSQL-Neon-4169e1?logo=postgresql" alt="PostgreSQL" />
  <img src="https://img.shields.io/badge/Deployed-Netlify-00c7b7?logo=netlify" alt="Netlify" />
</p>

---

## Tentang Proyek

Platform Company Profile modern untuk **PT Rekasaya Digital International** — perusahaan pengembang perangkat lunak skala enterprise. Website ini dibangun dari nol menggunakan arsitektur full-stack modern dengan Next.js 16 App Router, menampilkan:

- **Public Website** — Landing page dark glassmorphism, katalog layanan, portofolio proyek, blog/wawasan teknologi, halaman karier, dan formulir kontak/konsultasi.
- **Protected Admin Panel** — Dashboard terproteksi dengan autentikasi session token, CRUD lengkap seluruh konten, manajemen leads/booking, media library, dan audit logging keamanan.

> **Live Demo:** [https://pt-region-companyprofile-project2-nda.netlify.app](https://pt-region-companyprofile-project2-nda.netlify.app)

---

## Tech Stack

| Layer | Teknologi |
|---|---|
| **Framework** | Next.js 16.4 (App Router, Turbopack, Server Actions) |
| **Language** | TypeScript 5 |
| **UI Library** | React 19.3 |
| **Styling** | Tailwind CSS 4 (Dark Glassmorphism Theme) |
| **Database** | PostgreSQL (Neon Serverless) |
| **ORM** | Prisma 7 (Client Extensions, Adapter PG) |
| **Authentication** | Jose JWT + Bcrypt (Session Token, Rate Limiting) |
| **Validation** | Zod 4 (Schema Validation) |
| **Media Storage** | AWS S3 Compatible (via @aws-sdk/client-s3) |
| **Deployment** | Netlify (SSR, Edge Functions) |

---

## Fitur

### Public Website (Halaman Publik)

| Halaman | Deskripsi |
|---|---|
| **Beranda** | Hero section, ringkasan layanan, portofolio unggulan, CTA |
| **Layanan** | Katalog layanan enterprise dengan detail per-layanan |
| **Portofolio** | Showcase proyek dengan tech stack, galeri, dan deskripsi |
| **Blog / Wawasan** | Publikasi artikel & riset teknologi |
| **Karier** | Lowongan kerja dengan detail posisi dan formulir lamaran |
| **Mulai Proyek** | Formulir brief kebutuhan proyek (lead generation) |
| **Booking Konsultasi** | Penjadwalan diskusi teknis langsung dari website |
| **Kontak** | Formulir kontak, peta lokasi kantor, informasi perusahaan |

### Admin Panel (Dashboard Terproteksi)

| Modul | Deskripsi |
|---|---|
| **Dashboard** | Ringkasan metrik: total layanan, portofolio, artikel, leads, bookings |
| **Manajemen Layanan** | CRUD layanan (judul, deskripsi, ikon, tech stack) |
| **Manajemen Portofolio** | CRUD proyek (galeri gambar, tech stack, detail klien) |
| **Manajemen Blog** | CRUD artikel (rich content, status draft/published) |
| **Manajemen Karier** | CRUD lowongan (posisi, kualifikasi, status) |
| **Leads / Brief Proyek** | Pipeline CRM: status tracking, prioritas, follow-up |
| **Booking Konsultasi** | Manajemen jadwal konsultasi dari pengunjung |
| **Media Library** | Upload, kurasi, dan manajemen aset media |
| **Profil Perusahaan** | Edit informasi perusahaan yang tampil di public site |
| **Audit Logs** | Catatan lengkap seluruh aktivitas admin (keamanan) |
| **Ganti Password** | Fitur keamanan akun administrator |

### Keamanan

- Autentikasi berbasis **JWT Session Token** (Jose library)
- Password hashing dengan **Bcrypt**
- **Rate limiting** untuk mencegah brute-force login
- **Audit logging** — setiap aksi admin tercatat (CREATE, UPDATE, DELETE, LOGIN, EXPORT)
- Input validation menyeluruh dengan **Zod schema**

---

## Screenshots

### Halaman Publik

| Beranda | Layanan | Portofolio |
|:---:|:---:|:---:|
| ![Beranda](docs/screenshot/01-home.png) | ![Layanan](docs/screenshot/02-layanan.png) | ![Portofolio](docs/screenshot/03-portofolio.png) |

| Blog / Wawasan | Karier | Kontak |
|:---:|:---:|:---:|
| ![Blog](docs/screenshot/04-blog.png) | ![Karier](docs/screenshot/05-karier.png) | ![Kontak](docs/screenshot/06-kontak.png) |

| Mulai Proyek | Booking Konsultasi |
|:---:|:---:|
| ![Mulai Proyek](docs/screenshot/07-mulai-proyek.png) | ![Booking](docs/screenshot/08-booking.png) |

### Admin Panel

| Login | Dashboard | Profil Perusahaan |
|:---:|:---:|:---:|
| ![Login](docs/screenshot/09-admin-login.png) | ![Dashboard](docs/screenshot/11-admin-dashboard.png) | ![Profil](docs/screenshot/12-admin-profile.png) |

| Manajemen Layanan | Tambah Layanan | Manajemen Portofolio |
|:---:|:---:|:---:|
| ![Layanan](docs/screenshot/13-admin-services.png) | ![Tambah Layanan](docs/screenshot/14-admin-services-new.png) | ![Portofolio](docs/screenshot/15-admin-portfolio.png) |

| Tambah Portofolio | Manajemen Blog | Tambah Blog |
|:---:|:---:|:---:|
| ![Tambah Portofolio](docs/screenshot/16-admin-portfolio-new.png) | ![Blog](docs/screenshot/17-admin-blog.png) | ![Tambah Blog](docs/screenshot/18-admin-blog-new.png) |

| Manajemen Karier | Tambah Karier | Leads / Brief |
|:---:|:---:|:---:|
| ![Karier](docs/screenshot/19-admin-careers.png) | ![Tambah Karier](docs/screenshot/20-admin-careers-new.png) | ![Leads](docs/screenshot/21-admin-leads.png) |

| Bookings | Media Library | Audit Logs |
|:---:|:---:|:---:|
| ![Bookings](docs/screenshot/22-admin-bookings.png) | ![Media](docs/screenshot/23-admin-media.png) | ![Audit](docs/screenshot/24-admin-audit-logs.png) |

| Ganti Password |
|:---:|
| ![Ganti Password](docs/screenshot/10-admin-change-password.png) |

---

## Arsitektur Proyek

```
compro/
├── prisma/
│   ├── schema.prisma          # Database schema (24 models, 15 enums)
│   └── seed.ts                # Data seeder
├── src/
│   ├── app/
│   │   ├── (public)/          # Halaman publik
│   │   │   ├── page.tsx       # Beranda
│   │   │   ├── layanan/       # Katalog & detail layanan
│   │   │   ├── portofolio/    # Showcase & detail proyek
│   │   │   ├── blog/          # Artikel & detail post
│   │   │   ├── karier/        # Lowongan & detail posisi
│   │   │   ├── mulai-proyek/  # Formulir brief proyek
│   │   │   ├── booking/       # Booking konsultasi
│   │   │   └── kontak/        # Kontak & peta
│   │   ├── admin/
│   │   │   ├── (auth)/login/  # Halaman login admin
│   │   │   └── (dashboard)/   # Panel admin terproteksi
│   │   │       ├── dashboard/
│   │   │       ├── services/
│   │   │       ├── portfolio/
│   │   │       ├── blog/
│   │   │       ├── careers/
│   │   │       ├── leads/
│   │   │       ├── bookings/
│   │   │       ├── media/
│   │   │       ├── profile/
│   │   │       └── audit-logs/
│   │   └── actions/           # Server Actions (auth, CRUD)
│   ├── components/
│   │   ├── public/            # Komponen halaman publik
│   │   └── admin/             # Komponen panel admin
│   └── lib/
│       ├── prisma.ts          # Prisma client singleton
│       ├── auth.ts            # Auth utilities
│       ├── session.ts         # Session management (JWT)
│       └── s3.ts              # Media storage client
├── docs/
│   └── screenshot/            # Screenshot aplikasi (24 file)
├── public/                    # Static assets
└── package.json
```

---

## Getting Started

### Prerequisites

- **Node.js** 18+ (disarankan v22 LTS)
- **PostgreSQL** database (atau [Neon](https://neon.tech) serverless)
- **npm** atau **yarn**

### Instalasi

```bash
# Clone repository
git clone https://github.com/Central-Saga/Nanda-Project2-Company-Profile.git
cd Nanda-Project2-Company-Profile

# Install dependencies
npm install

# Setup environment variables
cp .env.example .env
# Edit .env — isi DATABASE_URL, JWT_SECRET, S3 credentials

# Generate Prisma client & push schema
npx prisma generate
npx prisma db push

# Seed database (data awal)
npx tsx prisma/seed.ts

# Jalankan development server
npm run dev
```

Buka [http://localhost:3000](http://localhost:3000) untuk melihat website.

### Environment Variables

| Variable | Deskripsi |
|---|---|
| `DATABASE_URL` | Connection string PostgreSQL |
| `JWT_SECRET` | Secret key untuk JWT session token |
| `AWS_ACCESS_KEY_ID` | S3-compatible storage access key |
| `AWS_SECRET_ACCESS_KEY` | S3-compatible storage secret key |
| `AWS_REGION` | S3 region |
| `S3_BUCKET_NAME` | Nama bucket S3 |

### Build & Deploy

```bash
# Production build
npm run build

# Start production server
npm start
```

Deployed on **Netlify** — push ke branch `main` untuk auto-deploy.

---

## Database Schema

Schema Prisma lengkap dengan **24 models** dan **15 enums**, mencakup:

- `User` — Akun administrator
- `CompanyProfile` — Informasi perusahaan
- `Service` / `ServiceDetail` — Layanan & detail
- `Portfolio` / `PortfolioGallery` / `PortfolioTechStack` — Proyek & galeri
- `BlogPost` — Artikel blog/wawasan
- `Career` — Lowongan kerja
- `Lead` / `LeadFollowUp` — Pipeline leads CRM
- `Booking` — Jadwal konsultasi
- `Media` — Aset media library
- `AuditLog` — Log keamanan admin
- Dan lainnya (Testimonial, FAQ, Award, TeamMember, dll.)

---

## Git Workflow

| Branch | Fungsi |
|---|---|
| `main` | Production — finished releases |
| `develop` | Ongoing team development |
| `feat/*` | Isolated features/fixes |

### Branch History

- `feat/public-landing` — Desain landing page publik
- `feat/database-and-backend` — Setup database schema & backend
- `feat/admin-dashboard` — Panel admin lengkap
- `feat/media-storage` — Integrasi media storage S3

---

## Demo

| | |
|---|---|
| **Live Website** | [https://pt-region-companyprofile-project2-nda.netlify.app](https://pt-region-companyprofile-project2-nda.netlify.app) |
| **Repository** | [github.com/Central-Saga/Nanda-Project2-Company-Profile](https://github.com/Central-Saga/Nanda-Project2-Company-Profile) |

---

## Lisensi

Proyek ini dikembangkan sebagai bagian dari portfolio SMK oleh **I Putu Nanda Putra Wiguna** — [Central-Saga](https://github.com/Central-Saga).

---

<p align="center">
  <sub>Built with Next.js 16 • React 19 • TypeScript • Tailwind CSS 4 • Prisma 7 • PostgreSQL</sub>
</p>
