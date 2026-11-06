import Link from "next/link";
import Image from "next/image";
import { prisma } from "@/lib/prisma";

export async function Navbar() {
  const company = await prisma.companyProfile.findFirst();
  const brandName = company?.companyName || "PT Rekasaya Digital International";

  return (
    <header className="sticky top-0 z-50 w-full border-b border-white/[0.08] bg-black/60 backdrop-blur-xl transition-all">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <Link href="/" className="flex items-center gap-3 group">
          <div className="relative w-8 h-8 rounded-lg overflow-hidden flex items-center justify-center bg-white/[0.03] border border-white/10 group-hover:border-red-500/40 transition">
            <Image
              src="/logo.png"
              alt="Logo"
              fill
              className="object-contain p-1"
              priority
            />
          </div>
          <span className="text-sm font-semibold tracking-tight text-white group-hover:text-zinc-200 transition">
            {brandName}
          </span>
        </Link>

        <nav className="hidden md:flex items-center gap-8 text-sm font-medium text-zinc-400">
          <Link href="/layanan" className="hover:text-white transition">
            Layanan
          </Link>
          <Link href="/portofolio" className="hover:text-white transition">
            Portofolio
          </Link>
          <Link href="/blog" className="hover:text-white transition">
            Wawasan
          </Link>
          <Link href="/karier" className="hover:text-white transition">
            Karier
          </Link>
          <Link href="/kontak" className="hover:text-white transition">
            Kontak
          </Link>
        </nav>

        <div className="flex items-center gap-3">
          <Link
            href="/mulai-proyek"
            className="px-4 py-2 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 text-white rounded-xl text-xs sm:text-sm font-medium transition shadow-[0_0_25px_rgba(220,38,38,0.35)] hover:shadow-[0_0_35px_rgba(220,38,38,0.5)] border border-red-500/30"
          >
            Mulai Proyek
          </Link>
        </div>
      </div>
    </header>
  );
}
