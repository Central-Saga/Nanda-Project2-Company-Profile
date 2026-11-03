import { prisma } from "@/lib/prisma";
import { notFound } from "next/navigation";
import Link from "next/link";

interface BlogPostPageProps {
  params: Promise<{ slug: string }>;
}

export async function generateMetadata({ params }: BlogPostPageProps) {
  const { slug } = await params;
  const post = await prisma.post.findFirst({
    where: { slug, status: "published", deletedAt: null },
    include: { translations: { where: { locale: "id" } } },
  });

  return {
    title: post?.translations[0]?.title || slug,
  };
}

export default async function BlogPostPage({ params }: BlogPostPageProps) {
  const { slug } = await params;
  const post = await prisma.post.findFirst({
    where: { slug, status: "published", deletedAt: null },
    include: {
      translations: { where: { locale: "id" } },
      author: true,
    },
  });

  if (!post) {
    notFound();
  }

  const trans = post.translations[0];
  const dateStr = post.publishedAt
    ? post.publishedAt.toISOString().split("T")[0]
    : "";

  return (
    <article className="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
      <Link
        href="/blog"
        className="text-xs font-mono text-zinc-500 hover:text-zinc-300 transition"
      >
        &larr; Kembali ke Daftar Artikel
      </Link>

      <header className="space-y-4 border-b border-zinc-900 pb-8">
        <div className="flex items-center gap-3 text-xs font-mono text-zinc-500">
          <time dateTime={dateStr}>{dateStr}</time>
          {post.author?.fullName && (
            <>
              <span>&bull;</span>
              <span>Oleh {post.author.fullName}</span>
            </>
          )}
        </div>

        <h1 className="text-3xl sm:text-4xl font-bold text-white uppercase leading-tight">
          {trans?.title || post.slug}
        </h1>
      </header>

      <div className="text-sm text-zinc-300 font-sans leading-relaxed whitespace-pre-line space-y-4">
        {trans?.content}
      </div>

      <footer className="pt-8 border-t border-zinc-900 flex justify-between items-center text-xs font-mono text-zinc-500">
        <Link href="/blog" className="hover:text-white transition">
          &larr; Arsip Tulisan Lainnya
        </Link>
        <Link href="/mulai-proyek" className="text-red-500 hover:text-red-400 transition">
          Diskusikan Penerapan Sistem &rarr;
        </Link>
      </footer>
    </article>
  );
}
