# DESIGN — PT. Central Saga Mandala (Modern Digital Agency Edition)

Arah desain UI/UX modern, minimalis, dan berstandar internasional untuk website company profile PT. Central Saga Mandala (Software House & Creative Agency, Tabanan, Bali).

## 1. Identitas & Karakter Brand

- **Nama Perusahaan:** PT. Central Saga Mandala (Central Saga)
- **Bidang:** Software House & Creative Agency
- **Domisili:** Tabanan, Bali, Indonesia
- **Logo Resmi:** Geometrik heksagonal hijau emerald (`public/images/logo.png`)
- **Karakter Visual:** Modern, minimalis, presisi tinggi, elegan, dan berkarakter digital agency premium (referensi estetika: Apple, Linear, Vercel, Awwwards).

## 2. Dials (Liveliness)

- **ENERGY (3 — Bertenaga & Tegas):** Kontras tinggi gelap (#080D0B) dengan aksen hijau emerald segar (#10B981, #34D399) dan pencahayaan ambient halus.
- **RHYTHM (2 — Beragam & Terstruktur):** Komposisi layout bervariasi antara hero interaktif, kartu layanan modular, galeri portofolio editorial, serta narasi identitas studio.
- **MOTION (2 — Responsif & Halus):** Transisi mikro 200-300ms pada tombol dan kartu, hover elevation halus, respect terhadap `prefers-reduced-motion`.

## 3. Palet Warna (Standar WCAG AA)

- `--c-bg-main`: `#080D0B` — Latar belakang utama bernuansa deep obsidian emerald gelap.
- `--c-bg-surface`: `#101713` — Latar belakang sekunder kartu dan panel modul.
- `--c-bg-glass`: `rgba(255, 255, 255, 0.045)` — Permukaan frosted glass transparan.
- `--c-border`: `rgba(255, 255, 255, 0.10)` — Garis batas teknis halus dan presisi.
- `--c-border-hover`: `rgba(16, 185, 129, 0.35)` — Highlight border saat interaksi.
- `--c-primary-green`: `#10B981` — Hijau emerald primer untuk aksen, status, dan CTA.
- `--c-accent-green`: `#34D399` — Hijau mint aksen untuk highlight teks dan hover state.
- `--c-text-primary`: `#F5F7F5` — Teks putih bersih untuk keterbacaan optimal (> 16:1 contrast).
- `--c-text-secondary`: `#A0ADA5` — Teks pendukung sekunder (contrast > 7:1).
- `--c-gold`: `#D4AF37` — Aksen emas terkalibrasi untuk metadata khusus dan rating bintang.

## 4. Tipografi

- **Display & Headings:** `Plus Jakarta Sans`, geometrik tegas dengan bobot 600/700/800, line-height proporsional 1.15-1.2, tracking ketat (`-0.025em`).
- **Body & Subheadline:** `Geist` / `Plus Jakarta Sans`, jernih, nyaman dibaca pada desktop dan mobile.
- **Technical & Metadata:** Monospace (`JetBrains Mono`, `ui-monospace`) untuk penomoran seksi, timestamp, dan tag teknis.

## 5. Komponen & Karakter Desain

- **Navbar:** Floating translucent glass navbar dengan blur 16px, logo proporsional, link rapi, dan tombol CTA tegas.
- **Hero:** Komposisi terpusat dengan tipografi kuat, deskripsi terukur, CTA jelas, serta kartu preview kapabilitas digital nyata (Spatial Clarity).
- **Services:** Kartu minimalis dengan icon SVG fungsional (bukan emoji), deskripsi konkret, dan interaksi hover.
- **Portfolio / Gallery:** Layout showcase editorial asimetris dengan preview gambar berkualitas dan modal lightbox.
- **Anti-Slop Hard Gate:**
  - Tanpa karakter em dash (`—`).
  - Tanpa emoji generik AI (✨, 🚀, ⚡) sebagai icon.
  - Tanpa jargon pemasaran AI palsu ("AI-Powered", "Revolutionary").
  - Tanpa metrik atau testimoni fiktif; semua data dinamis dari database.
  - Seluruh tombol dan tautan aktif memiliki aksi nyata.
