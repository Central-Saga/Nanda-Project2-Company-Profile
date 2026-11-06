import Link from "next/link";
import Image from "next/image";
import { prisma } from "@/lib/prisma";

export async function Footer() {
  const company = await prisma.companyProfile.findFirst();

  const brandName = company?.companyName || "PT Rekasaya Digital International";
  const tagline = company?.tagline || "Solusi Rekayasa Perangkat Lunak Skala Enterprise";

  return (
    <footer className="w-full border-t border-white/[0.08] bg-black/80 backdrop-blur-xl text-zinc-400 text-xs">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-10">
          <div className="md:col-span-2 space-y-4">
            <div className="flex items-center gap-3">
              <div className="relative w-7 h-7 rounded-lg overflow-hidden flex items-center justify-center bg-white/[0.03] border border-white/10">
                <Image
                  src="/logo.png"
                  alt="Logo"
                  fill
                  className="object-contain p-0.5"
                />
              </div>
              <span className="font-semibold text-sm tracking-tight text-white">
                {brandName}
              </span>
            </div>
            <p className="text-zinc-400 text-xs max-w-sm leading-relaxed">
              {tagline}
            </p>
            {company?.address && (
              <p className="text-zinc-400 text-xs leading-relaxed">
                {company.address}
              </p>
            )}
            <div className="pt-2 text-xs text-zinc-400 space-y-1">
              {company?.emailPublic && <div>Email: {company.emailPublic}</div>}
              {company?.phone && <div>Telp: {company.phone}</div>}
            </div>
          </div>

          <div className="space-y-3">
            <div className="text-zinc-200 font-semibold text-xs tracking-wider uppercase">
              Eksplorasi
            </div>
            <ul className="space-y-2.5 text-zinc-400">
              <li>
                <Link href="/layanan" className="hover:text-white transition">
                  Layanan Rekayasa
                </Link>
              </li>
              <li>
                <Link href="/portofolio" className="hover:text-white transition">
                  Portofolio & Studi Kasus
                </Link>
              </li>
              <li>
                <Link href="/blog" className="hover:text-white transition">
                  Wawasan & Riset
                </Link>
              </li>
              <li>
                <Link href="/karier" className="hover:text-white transition">
                  Peluang Karir
                </Link>
              </li>
            </ul>
          </div>

          <div className="space-y-3">
            <div className="text-zinc-200 font-semibold text-xs tracking-wider uppercase">
              Hubungi Kami
            </div>
            <ul className="space-y-2.5 text-zinc-400">
              <li>
                <Link href="/mulai-proyek" className="hover:text-white transition">
                  Kirim Brief Proyek
                </Link>
              </li>
              <li>
                <Link href="/booking" className="hover:text-white transition">
                  Jadwalkan Konsultasi
                </Link>
              </li>
              <li>
                <Link href="/kontak" className="hover:text-white transition">
                  Formulir Kontak
                </Link>
              </li>
            </ul>
          </div>
        </div>

        <div className="mt-12 pt-6 border-t border-white/[0.08] flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-zinc-400">
          <div>
            &copy; {new Date().getFullYear()} {brandName}. Hak Cipta Dilindungi.
          </div>
          <div className="text-xs text-zinc-400">
            Sistem Database Terintegrasi &bull; Privasi Terjaga
          </div>
        </div>
      </div>
    </footer>
  );
}
