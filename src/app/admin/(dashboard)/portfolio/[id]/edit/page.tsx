import { prisma } from "@/lib/prisma";
import { PageHeader } from "@/components/admin/PageHeader";
import { ProjectForm } from "../../ProjectForm";
import { notFound } from "next/navigation";

export const metadata = {
  title: "Edit Portofolio",
};

interface EditProjectPageProps {
  params: Promise<{ id: string }>;
}

export default async function EditProjectPage({ params }: EditProjectPageProps) {
  const { id } = await params;

  const project = await prisma.project.findUnique({
    where: { id },
    include: {
      translations: { where: { locale: "id" } },
    },
  });

  if (!project || project.deletedAt) {
    notFound();
  }

  const trans = project.translations[0];

  const initialData = {
    id: project.id,
    slug: project.slug,
    projectUrl: project.projectUrl,
    startedAt: project.startedAt ? project.startedAt.toISOString().split("T")[0] : null,
    completedAt: project.completedAt ? project.completedAt.toISOString().split("T")[0] : null,
    durationMonths: project.durationMonths,
    teamSize: project.teamSize,
    isFeatured: project.isFeatured,
    isPublished: project.isPublished,
    sortOrder: project.sortOrder,
    title: trans?.title || "",
    summary: trans?.summary || "",
    challenge: trans?.challenge || "",
    solution: trans?.solution || "",
    result: trans?.result || "",
    content: trans?.content || "",
  };

  return (
    <div>
      <PageHeader
        title={`Edit Portofolio: ${initialData.title}`}
        description="Perbarui konten studi kasus, dampak teknis, atau status publikasi."
      />
      <ProjectForm initialData={initialData} />
    </div>
  );
}
