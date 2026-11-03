import Link from "next/link";
import { prisma } from "@/lib/prisma";

export async function Navbar() {
  const company = await prisma.companyProfile.findFirst();
  const brandName = company?.companyName || "SOFTWARE HOUSE";

  return (
    <header className="sticky top-0 z-40 w-full border-b border-zinc-900 bg-black/85 backdrop-blur-sm">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <Link href="/" className="flex items-center gap-2 group">
          <span className="w-2.5 h-2.5 bg-red-600 rounded-none group-hover:scale-110 transition-transform" />
          <span className="font-mono text-sm font-bold tracking-widest text-zinc-100 uppercase">
            {brandName}
          </span>
        </Link>

        <nav className="hidden md:flex items-center gap-6 text-xs font-mono tracking-wider uppercase text-zinc-400">
          <Link href="/layanan" className="hover:text-zinc-100 transition">
            Layanan
          </Link>
          <Link href="/portofolio" className="hover:text-zinc-100 transition">
            Portofolio
          </Link>
          <Link href="/blog" className="hover:text-zinc-100 transition">
            Wawasan
          </Link>
          <Link href="/karier" className="hover:text-zinc-100 transition">
            Karier
          </Link>
          <Link href="/kontak" className="hover:text-zinc-100 transition">
            Kontak
          </Link>
        </nav>

        <div className="flex items-center gap-3">
          <Link
            href="/mulai-proyek"
            className="px-3.5 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-mono font-medium uppercase tracking-wider transition"
          >
            Mulai Proyek
          </Link>
          <Link
            href="/admin"
            className="hidden sm:inline-block px-2.5 py-1 text-zinc-500 hover:text-zinc-300 rounded border border-zinc-900 hover:border-zinc-800 text-[11px] font-mono transition"
          >
            Console
          </Link>
        </div>
      </div>
    </header>
  );
}
