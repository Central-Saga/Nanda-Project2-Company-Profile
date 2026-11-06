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
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 space-y-12">
      <div className="max-w-2xl space-y-3">
        <span className="text-xs font-semibold uppercase tracking-wider text-red-500">
          Publikasi
        </span>
        <h1 className="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
          Wawasan Teknis & Arsitektur
        </h1>
        <p className="text-sm sm:text-base text-zinc-400 leading-relaxed font-normal">
          Artikel rekayasa, pola arsitektur, dan pemikiran mendalam mengenai ekosistem perangkat lunak modern.
        </p>
      </div>

      {posts.length === 0 ? (
        <div className="p-12 text-center rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl text-zinc-400 text-sm">
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
                className="p-7 rounded-2xl bg-white/[0.03] hover:bg-white/[0.05] border border-white/[0.08] hover:border-white/[0.18] backdrop-blur-xl space-y-4 transition flex flex-col justify-between shadow-xl"
              >
                <div className="space-y-3">
                  <div className="text-xs text-zinc-400">
                    {dateStr}
                  </div>

                  <h2 className="text-base font-bold text-white line-clamp-2">
                    {trans?.title || post.slug}
                  </h2>

                  <p className="text-sm text-zinc-400 line-clamp-3 leading-relaxed">
                    {trans?.content || ""}
                  </p>
                </div>

                <div className="pt-4 border-t border-white/[0.06]">
                  <Link
                    href={`/blog/${post.slug}`}
                    className="text-xs font-semibold text-zinc-300 hover:text-white transition flex items-center gap-1.5"
                  >
                    <span>Baca Artikel</span>
                    <span>&rarr;</span>
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
