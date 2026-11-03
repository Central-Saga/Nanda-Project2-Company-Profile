import { prisma } from "@/lib/prisma";
import { PageHeader } from "@/components/admin/PageHeader";
import { ServiceForm } from "../../ServiceForm";
import { notFound } from "next/navigation";

export const metadata = {
  title: "Edit Layanan",
};

interface EditServicePageProps {
  params: Promise<{ id: string }>;
}

export default async function EditServicePage({ params }: EditServicePageProps) {
  const { id } = await params;

  const service = await prisma.service.findUnique({
    where: { id },
    include: {
      translations: { where: { locale: "id" } },
    },
  });

  if (!service || service.deletedAt) {
    notFound();
  }

  const trans = service.translations[0];

  const initialData = {
    id: service.id,
    slug: service.slug,
    icon: service.icon,
    sortOrder: service.sortOrder,
    isPublished: service.isPublished,
    name: trans?.name || "",
    tagline: trans?.tagline || "",
    summary: trans?.summary || "",
    description: trans?.description || "",
  };

  return (
    <div>
      <PageHeader
        title={`Edit Layanan: ${initialData.name}`}
        description="Perbarui informasi atau status publikasi layanan ini."
      />
      <ServiceForm initialData={initialData} />
    </div>
  );
}
