import Link from "next/link";
import { prisma } from "@/lib/prisma";

export async function Navbar() {
  const company = await prisma.companyProfile.findFirst();
  const brandName = company?.companyName || "PT Rekasaya Digital International";

  return (
    <header className="sticky top-0 z-50 w-full border-b border-white/[0.08] bg-black/60 backdrop-blur-xl transition-all">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <Link href="/" className="flex items-center gap-3 group">
          <div className="w-8 h-8 rounded-xl bg-white/[0.05] border border-white/10 flex items-center justify-center backdrop-blur-md group-hover:border-white/25 transition">
            <div className="w-3 h-3 rounded-full bg-red-500 shadow-[0_0_12px_rgba(239,68,68,0.8)]" />
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
            href="/admin"
            className="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 text-zinc-400 hover:text-white rounded-full bg-white/[0.03] hover:bg-white/[0.08] border border-white/[0.08] text-xs font-medium transition backdrop-blur-md"
          >
            <span className="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse" />
            Portal Admin
          </Link>
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
