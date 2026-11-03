import { Pool } from "pg";
import { PrismaPg } from "@prisma/adapter-pg";
import { PrismaClient } from "@prisma/client";
import bcrypt from "bcryptjs";
import "dotenv/config";

const pool = new Pool({ connectionString: process.env.DATABASE_URL });
const adapter = new PrismaPg(pool);
const prisma = new PrismaClient({ adapter });

async function main() {
  console.log("Seeding database...");

  // 1. Roles & Permissions
  const superAdminRole = await prisma.role.upsert({
    where: { name: "super_admin" },
    update: {},
    create: {
      name: "super_admin",
      description: "Super Administrator with full access",
    },
  });

  const editorRole = await prisma.role.upsert({
    where: { name: "editor" },
    update: {},
    create: {
      name: "editor",
      description: "Editor for content management",
    },
  });

  const permissions = [
    { action: "manage", subject: "all" },
    { action: "read", subject: "all" },
    { action: "create", subject: "content" },
    { action: "update", subject: "content" },
    { action: "delete", subject: "content" },
  ];

  for (const perm of permissions) {
    const p = await prisma.permission.upsert({
      where: {
        action_subject: { action: perm.action, subject: perm.subject },
      },
      update: {},
      create: perm,
    });

    await prisma.rolePermission.upsert({
      where: {
        roleId_permissionId: {
          roleId: superAdminRole.id,
          permissionId: p.id,
        },
      },
      update: {},
      create: {
        roleId: superAdminRole.id,
        permissionId: p.id,
      },
    });
  }

  // 2. Initial Admin User
  const adminEmail = process.env.ADMIN_EMAIL || "admin@example.com";
  const adminPassword = process.env.ADMIN_INITIAL_PASSWORD || "ChangeMe123!";
  const passwordHash = await bcrypt.hash(adminPassword, 12);

  const adminUser = await prisma.user.upsert({
    where: { email: adminEmail },
    update: {},
    create: {
      email: adminEmail,
      fullName: "System Administrator",
      passwordHash,
      roleId: superAdminRole.id,
      mustChangePassword: true,
      isActive: true,
    },
  });
  console.log(`Admin user ready: ${adminUser.email}`);

  // 3. Design Direction (Lampiran B defaults)
  const existingDirection = await prisma.designDirection.findFirst();
  if (!existingDirection) {
    await prisma.designDirection.create({
      data: {
        brandName: "Software House",
        tagline: "High Performance Digital Engineering",
        energy: 2,
        rhythm: 2,
        motion: 2,
        themePolicy: "dark",
        themeReason: "Dark single theme with red accent as per Appendix B spec.",
        status: "approved",
        approvedBy: adminUser.id,
        approvedAt: new Date(),
        palette: {
          primary: "#09090b",
          accent: "#dc2626",
          surface: "#18181b",
          text: "#f4f4f5",
          mutedText: "#a1a1aa",
          border: "#27272a",
        },
        typography: {
          sans: "Geist, sans-serif",
          mono: "GeistMono, monospace",
        },
      },
    });
    console.log("Design direction seeded.");
  }

  // 4. Default Company Profile
  const existingProfile = await prisma.companyProfile.findFirst();
  if (!existingProfile) {
    await prisma.companyProfile.create({
      data: {
        companyName: "PT Digital Solusi Indonesia",
        tagline: "Software Engineering & Cloud Architecture",
        aboutShort:
          "Kami membangun solusi enterprise, platform web berkinerja tinggi, dan arsitektur cloud terpercaya.",
        address: "Jakarta, Indonesia",
        phone: "+62 21 555 0199",
        emailPublic: "contact@company.example",
        operatingHours: {
          mon_fri: "09:00 - 18:00 WIB",
          sat_sun: "Tutup",
        },
        socialLinks: {
          github: "https://github.com",
          linkedin: "https://linkedin.com",
        },
        updatedBy: adminUser.id,
      },
    });
    console.log("Company profile seeded.");
  }

  // 5. Default Header/Footer Navigation Menus
  const menus = [
    { label: "Layanan", url: "/services", sortOrder: 1, location: "header" as const },
    { label: "Portofolio", url: "/portfolio", sortOrder: 2, location: "header" as const },
    { label: "Tentang Kami", url: "/about", sortOrder: 3, location: "header" as const },
    { label: "Blog", url: "/blog", sortOrder: 4, location: "header" as const },
    { label: "Karir", url: "/careers", sortOrder: 5, location: "header" as const },
    { label: "Kontak", url: "/contact", sortOrder: 6, location: "header" as const },
  ];

  for (const item of menus) {
    const existing = await prisma.menuItem.findFirst({
      where: { url: item.url, menuLocation: item.location },
    });
    if (!existing) {
      const created = await prisma.menuItem.create({
        data: {
          menuLocation: item.location,
          url: item.url,
          sortOrder: item.sortOrder,
          isActive: true,
        },
      });

      await prisma.menuItemTranslation.create({
        data: {
          menuItemId: created.id,
          locale: "id",
          label: item.label,
        },
      });
    }
  }
  console.log("Menu items seeded.");

  console.log("Seeding finished successfully.");
}

main()
  .catch((e) => {
    console.error("Seed error:", e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
    await pool.end();
  });
