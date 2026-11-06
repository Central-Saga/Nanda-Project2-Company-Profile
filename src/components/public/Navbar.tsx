import Link from "next/link";
import { prisma } from "@/lib/prisma";

export async function Navbar() {
  const company = await prisma.companyProfile.findFirst();
  const brandName = company?.companyName || "PT REKASAYA DIGITAL";

  return (
    <header className="sticky top-0 z-50 w-full border-b border-zinc-800/80 bg-black/90 backdrop-blur-md">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <Link href="/" className="flex items-center gap-2.5 group">
          <div className="w-5 h-5 bg-black border border-red-600 flex items-center justify-center relative overflow-hidden group-hover:border-red-500 transition-colors">
            <div className="w-2 h-2 bg-red-600 group-hover:scale-125 transition-transform" />
          </div>
          <span className="font-mono text-xs sm:text-sm font-bold tracking-widest text-zinc-100 uppercase group-hover:text-red-400 transition-colors">
            {brandName}
          </span>
        </Link>

        <nav className="hidden md:flex items-center gap-7 text-xs font-mono tracking-wider uppercase text-zinc-400">
          <Link href="/layanan" className="hover:text-red-400 transition-colors">
            /layanan
          </Link>
          <Link href="/portofolio" className="hover:text-red-400 transition-colors">
            /portofolio
          </Link>
          <Link href="/blog" className="hover:text-red-400 transition-colors">
            /wawasan
          </Link>
          <Link href="/karier" className="hover:text-red-400 transition-colors">
            /karier
          </Link>
          <Link href="/kontak" className="hover:text-red-400 transition-colors">
            /kontak
          </Link>
        </nav>

        <div className="flex items-center gap-3">
          <Link
            href="/admin"
            className="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-1 text-zinc-500 hover:text-zinc-200 border border-zinc-800 hover:border-zinc-700 rounded text-[11px] font-mono transition"
          >
            <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse" />
            CONSOLE
          </Link>
          <Link
            href="/mulai-proyek"
            className="px-4 py-1.5 bg-red-600 hover:bg-red-500 text-white rounded text-xs font-mono font-semibold uppercase tracking-wider transition shadow-[0_0_15px_rgba(220,38,38,0.3)] hover:shadow-[0_0_20px_rgba(220,38,38,0.5)]"
          >
            Mulai Proyek
          </Link>
        </div>
      </div>
    </header>
  );
}
