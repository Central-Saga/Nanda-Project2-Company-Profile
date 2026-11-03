import { prisma } from "@/lib/prisma";
import Link from "next/link";

export const metadata = {
  title: "Wawasan & Artikel Teknis",
};

export default async function BlogPage() {
  const posts = await prisma.post.findMany({
    where: { status: "published", deletedAt: null },
    include: {
      translations: { where: { locale: "id" } },
      category: {
        include: { translations: { where: { locale: "id" } } },
      },
    },
    orderBy: { publishedAt: "desc" },
  });

  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
      <div className="max-w-2xl space-y-3">
        <span className="text-xs font-mono uppercase tracking-widest text-red-500">
          Publikasi
        </span>
        <h1 className="text-3xl font-bold text-white uppercase">
          Wawasan Teknis & Arsitektur
        </h1>
        <p className="text-sm text-zinc-400 font-sans">
          Artikel rekayasa, pola arsitektur, dan pemikiran mendalam mengenai ekosistem perangkat lunak modern.
        </p>
      </div>

      {posts.length === 0 ? (
        <div className="p-12 text-center border border-zinc-900 rounded-lg text-zinc-500 font-mono text-xs">
          Belum ada artikel yang dipublikasikan.
        </div>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {posts.map((post) => {
            const trans = post.translations[0];
            const dateStr = post.publishedAt
              ? post.publishedAt.toISOString().split("T")[0]
              : "";

            return (
              <div
                key={post.id}
                className="p-6 bg-zinc-950 border border-zinc-900 hover:border-zinc-800 rounded-lg space-y-4 transition flex flex-col justify-between"
              >
                <div className="space-y-3">
                  <div className="text-[11px] font-mono text-zinc-500">
                    {dateStr}
                  </div>

                  <h2 className="text-base font-bold text-white line-clamp-2">
                    {trans?.title || post.slug}
                  </h2>

                  <p className="text-xs text-zinc-400 font-sans line-clamp-3 leading-relaxed">
                    {trans?.content || ""}
                  </p>
                </div>

                <div className="pt-4 border-t border-zinc-900">
                  <Link
                    href={`/blog/${post.slug}`}
                    className="text-xs font-mono text-red-500 hover:text-red-400 transition"
                  >
                    Baca Artikel &rarr;
                  </Link>
                </div>
              </div>
            );
          })}
        </div>
      )}
    </div>
  );
}
