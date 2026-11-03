import { PageHeader } from "@/components/admin/PageHeader";
import { ProjectForm } from "../ProjectForm";

export const metadata = {
  title: "Tambah Portofolio Baru",
};

export default function NewProjectPage() {
  return (
    <div>
      <PageHeader
        title="Tambah Portofolio Baru"
        description="Dokumentasikan studi kasus proyek baru yang telah dikerjakan."
      />
      <ProjectForm />
    </div>
  );
}
