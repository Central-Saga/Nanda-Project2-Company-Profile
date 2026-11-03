import Link from "next/link";
import { prisma } from "@/lib/prisma";

export async function Footer() {
  const company = await prisma.companyProfile.findFirst();

  const brandName = company?.companyName || "SOFTWARE HOUSE";
  const tagline = company?.tagline || "Solusi Rekayasa Perangkat Lunak Skala Enterprise";

  return (
    <footer className="w-full border-t border-zinc-900 bg-zinc-950 text-zinc-400 text-xs font-mono">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div className="md:col-span-2 space-y-3">
            <div className="flex items-center gap-2">
              <span className="w-2.5 h-2.5 bg-red-600 rounded-none" />
              <span className="font-bold tracking-widest text-zinc-100 uppercase">
                {brandName}
              </span>
            </div>
            <p className="text-zinc-500 font-sans text-xs max-w-sm">
              {tagline}
            </p>
            {company?.address && (
              <p className="text-zinc-500 font-sans text-xs">
                {company.address}
              </p>
            )}
            <div className="pt-2 text-[11px] text-zinc-600 space-y-1">
              {company?.emailPublic && <div>Email: {company.emailPublic}</div>}
              {company?.phone && <div>Telp: {company.phone}</div>}
            </div>
          </div>

          <div className="space-y-3">
            <div className="text-zinc-200 font-bold uppercase tracking-wider">
              Eksplorasi
            </div>
            <ul className="space-y-2 text-zinc-500">
              <li>
                <Link href="/layanan" className="hover:text-zinc-200 transition">
                  Layanan Rekayasa
                </Link>
              </li>
              <li>
                <Link href="/portofolio" className="hover:text-zinc-200 transition">
                  Portofolio & Studi Kasus
                </Link>
              </li>
              <li>
                <Link href="/blog" className="hover:text-zinc-200 transition">
                  Artikel & Publikasi
                </Link>
              </li>
              <li>
                <Link href="/karier" className="hover:text-zinc-200 transition">
                  Peluang Karir
                </Link>
              </li>
            </ul>
          </div>

          <div className="space-y-3">
            <div className="text-zinc-200 font-bold uppercase tracking-wider">
              Hubungi Kami
            </div>
            <ul className="space-y-2 text-zinc-500">
              <li>
                <Link href="/mulai-proyek" className="hover:text-zinc-200 transition">
                  Kirim Brief Proyek
                </Link>
              </li>
              <li>
                <Link href="/booking" className="hover:text-zinc-200 transition">
                  Jadwalkan Konsultasi
                </Link>
              </li>
              <li>
                <Link href="/kontak" className="hover:text-zinc-200 transition">
                  Formulir Kontak
                </Link>
              </li>
            </ul>
          </div>
        </div>

        <div className="mt-12 pt-6 border-t border-zinc-900 flex flex-col sm:flex-row justify-between items-center gap-4 text-[11px] text-zinc-600">
          <div>
            &copy; {new Date().getFullYear()} {brandName}. Hak Cipta Dilindungi Undang-Undang.
          </div>
          <div className="font-sans text-[11px] text-zinc-500">
            Arsitektur Tanpa-WhatsApp &bull; Database-Driven &bull; Dark Aesthetic
          </div>
        </div>
      </div>
    </footer>
  );
}
