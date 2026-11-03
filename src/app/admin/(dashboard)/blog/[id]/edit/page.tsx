import { prisma } from "@/lib/prisma";
import { PageHeader } from "@/components/admin/PageHeader";
import { PostForm } from "../../PostForm";
import { notFound } from "next/navigation";

export const metadata = {
  title: "Edit Artikel",
};

interface EditPostPageProps {
  params: Promise<{ id: string }>;
}

export default async function EditPostPage({ params }: EditPostPageProps) {
  const { id } = await params;

  const [post, categoriesRaw] = await Promise.all([
    prisma.post.findUnique({
      where: { id },
      include: {
        translations: { where: { locale: "id" } },
      },
    }),
    prisma.postCategory.findMany({
      include: {
        translations: { where: { locale: "id" } },
      },
    }),
  ]);

  if (!post || post.deletedAt) {
    notFound();
  }

  const trans = post.translations[0];
  const categories = categoriesRaw.map((c) => ({
    id: c.id,
    name: c.translations[0]?.name || c.slug,
  }));

  const initialData = {
    id: post.id,
    slug: post.slug,
    categoryId: post.categoryId,
    status: post.status as "draft" | "published",
    isFeatured: post.isFeatured,
    title: trans?.title || "",
    excerpt: trans?.excerpt || "",
    content: trans?.content || "",
  };

  return (
    <div>
      <PageHeader
        title={`Edit Artikel: ${initialData.title}`}
        description="Perbarui konten, kategori, atau status publikasi artikel."
      />
      <PostForm categories={categories} initialData={initialData} />
    </div>
  );
}
