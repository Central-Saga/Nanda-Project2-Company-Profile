import { prisma } from "@/lib/prisma";
import { PageHeader } from "@/components/admin/PageHeader";
import { PostForm } from "../PostForm";

export const metadata = {
  title: "Tulis Artikel Baru",
};

export default async function NewPostPage() {
  const categoriesRaw = await prisma.postCategory.findMany({
    include: {
      translations: { where: { locale: "id" } },
    },
  });

  const categories = categoriesRaw.map((c) => ({
    id: c.id,
    name: c.translations[0]?.name || c.slug,
  }));

  return (
    <div>
      <PageHeader
        title="Tulis Artikel Baru"
        description="Publikasikan tulisan atau riset teknologi baru ke website."
      />
      <PostForm categories={categories} />
    </div>
  );
}
