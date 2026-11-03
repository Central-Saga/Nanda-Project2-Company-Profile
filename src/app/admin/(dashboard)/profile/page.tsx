import { prisma } from "@/lib/prisma";
import { PageHeader } from "@/components/admin/PageHeader";
import { CompanyProfileForm } from "./CompanyProfileForm";

export const metadata = {
  title: "Profil Perusahaan",
};

export default async function ProfilePage() {
  const profile = await prisma.companyProfile.findFirst();

  const formattedData = {
    companyName: profile?.companyName || "",
    tagline: profile?.tagline || "",
    aboutShort: profile?.aboutShort || "",
    address: profile?.address || "",
    phone: profile?.phone || "",
    emailPublic: profile?.emailPublic || "",
    operatingHours: profile?.operatingHours
      ? JSON.stringify(profile.operatingHours, null, 2)
      : "",
    socialLinks: profile?.socialLinks
      ? JSON.stringify(profile.socialLinks, null, 2)
      : "",
  };

  return (
    <div>
      <PageHeader
        title="Profil & Identitas Perusahaan"
        description="Kelola informasi publik, kontak resmi, dan profil operasional perusahaan."
      />
      <CompanyProfileForm initialData={formattedData} />
    </div>
  );
}
