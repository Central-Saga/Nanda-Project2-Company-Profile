import { PageHeader } from "@/components/admin/PageHeader";
import { ServiceForm } from "../ServiceForm";

export const metadata = {
  title: "Tambah Layanan Baru",
};

export default function NewServicePage() {
  return (
    <div>
      <PageHeader
        title="Tambah Layanan Baru"
        description="Buat penawaran kapabilitas baru untuk ditampilkan pada website."
      />
      <ServiceForm />
    </div>
  );
}
