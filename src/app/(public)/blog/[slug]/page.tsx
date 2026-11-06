import { prisma } from "@/lib/prisma";
import Link from "next/link";
import { notFound } from "next/navigation";

interface Props {
  params: Promise<{ slug: string }>;
}

export async function generateMetadata({ params }: Props) {
  const { slug } = await params;
  const post = await prisma.post.findUnique({
    where: { slug },
    include: { translations: { where: { locale: "id" } } },
  });

  return {
    title: post?.translations[0]?.title || slug,
  };
}

export default async function BlogPostPage({ params }: Props) {
  const { slug } = await params;
  const post = await prisma.post.findUnique({
    where: { slug },
    include: {
      translations: { where: { locale: "id" } },
      category: {
        include: { translations: { where: { locale: "id" } } },
      },
    },
  });

  if (!post || post.status !== "published" || post.deletedAt) {
    notFound();
  }

  const trans = post.translations[0];
  const dateStr = post.publishedAt
    ? post.publishedAt.toISOString().split("T")[0]
    : "";

  return (
    <div className="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-20 space-y-10">
      <Link
        href="/blog"
        className="text-xs font-medium text-zinc-400 hover:text-white transition flex items-center gap-1.5"
      >
        <span>&larr;</span>
        <span>Kembali ke Wawasan</span>
      </Link>

      <div className="space-y-4">
        <div className="flex items-center gap-3 text-xs text-zinc-400">
          <span>{dateStr}</span>
          {post.category && (
            <>
              <span>&bull;</span>
              <span className="text-zinc-300 font-medium">
                {post.category.translations[0]?.name || post.category.slug}
              </span>
            </>
          )}
        </div>

        <h1 className="text-3xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
          {trans?.title || post.slug}
        </h1>
      </div>

      <div className="p-8 rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl">
        <div className="text-zinc-300 text-sm sm:text-base leading-relaxed whitespace-pre-line space-y-4 font-normal">
          {trans?.content || ""}
        </div>
      </div>

      <footer className="pt-8 border-t border-white/[0.08] flex justify-between items-center text-xs text-zinc-400">
        <Link href="/blog" className="hover:text-white transition">
          &larr; Indeks Artikel
        </Link>
        <Link href="/mulai-proyek" className="text-red-400 hover:text-red-300 transition font-medium">
          Mulai Diskusi Proyek &rarr;
        </Link>
      </footer>
    </div>
  );
}
