import { prisma } from "@/lib/prisma";
import { MobileNavbar } from "./MobileNavbar";

export async function Navbar() {
  const company = await prisma.companyProfile.findFirst();
  const brandName = company?.companyName || "PT Rekasaya Digital International";

  return <MobileNavbar brandName={brandName} />;
}
