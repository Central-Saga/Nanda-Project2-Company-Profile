import { prisma } from "@/lib/prisma";
import { PageHeader } from "@/components/admin/PageHeader";
import { JobForm } from "../../JobForm";
import { notFound } from "next/navigation";

export const metadata = {
  title: "Edit Lowongan Karir",
};

interface EditJobPageProps {
  params: Promise<{ id: string }>;
}

export default async function EditJobPage({ params }: EditJobPageProps) {
  const { id } = await params;

  const job = await prisma.jobOpening.findUnique({
    where: { id },
    include: {
      translations: { where: { locale: "id" } },
    },
  });

  if (!job) {
    notFound();
  }

  const trans = job.translations[0];

  const initialData = {
    id: job.id,
    slug: job.slug,
    department: job.department,
    employmentType: job.employmentType,
    workMode: job.workMode,
    location: job.location,
    salaryMin: job.salaryMin ? Number(job.salaryMin) : null,
    salaryMax: job.salaryMax ? Number(job.salaryMax) : null,
    showSalary: job.showSalary,
    status: job.status,
    closesAt: job.closesAt ? job.closesAt.toISOString().split("T")[0] : null,
    title: trans?.title || "",
    description: trans?.description || "",
    responsibilities: trans?.responsibilities || "",
    requirements: trans?.requirements || "",
    benefits: trans?.benefits || "",
  };

  return (
    <div>
      <PageHeader
        title={`Edit Lowongan: ${initialData.title}`}
        description="Perbarui informasi kualifikasi, batas lamaran, atau status penayangan."
      />
      <JobForm initialData={initialData} />
    </div>
  );
}
