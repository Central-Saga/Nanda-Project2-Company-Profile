import { PageHeader } from "@/components/admin/PageHeader";
import { JobForm } from "../JobForm";

export const metadata = {
  title: "Buka Lowongan Karir Baru",
};

export default function NewJobPage() {
  return (
    <div>
      <PageHeader
        title="Buka Lowongan Karir Baru"
        description="Siapkan deskripsi kebutuhan posisi dan kualifikasi talenta rekayasa."
      />
      <JobForm />
    </div>
  );
}
