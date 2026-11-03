import { z } from "zod";

// ── Company Profile ──
export const companyProfileSchema = z.object({
  companyName: z.string().min(1, "Nama perusahaan wajib diisi").max(150, "Maksimal 150 karakter"),
  tagline: z.string().max(255, "Maksimal 255 karakter").optional().or(z.literal("")),
  aboutShort: z.string().optional().or(z.literal("")),
  address: z.string().optional().or(z.literal("")),
  phone: z.string().max(50, "Maksimal 50 karakter").optional().or(z.literal("")),
  emailPublic: z.string().email("Format email tidak valid").optional().or(z.literal("")),
  operatingHours: z.string().optional().or(z.literal("")),
  socialLinks: z.string().optional().or(z.literal("")),
});

export type CompanyProfileInput = z.infer<typeof companyProfileSchema>;

// ── Service ──
export const serviceSchema = z.object({
  slug: z
    .string()
    .min(1, "Slug wajib diisi")
    .max(150, "Maksimal 150 karakter")
    .regex(/^[a-z0-9]+(?:-[a-z0-9]+)*$/, "Slug hanya boleh huruf kecil, angka, dan tanda hubung"),
  icon: z.string().max(100, "Maksimal 100 karakter").optional().or(z.literal("")),
  sortOrder: z.coerce.number().int("Harus bilangan bulat").min(0, "Minimal 0").default(0),
  isPublished: z.coerce.boolean().default(false),
  // Translation fields (id locale)
  name: z.string().min(1, "Nama layanan wajib diisi").max(200, "Maksimal 200 karakter"),
  tagline: z.string().max(255, "Maksimal 255 karakter").optional().or(z.literal("")),
  summary: z.string().optional().or(z.literal("")),
  description: z.string().optional().or(z.literal("")),
});

export type ServiceInput = z.infer<typeof serviceSchema>;

// ── Project (Portfolio) ──
export const projectSchema = z.object({
  slug: z
    .string()
    .min(1, "Slug wajib diisi")
    .max(180, "Maksimal 180 karakter")
    .regex(/^[a-z0-9]+(?:-[a-z0-9]+)*$/, "Slug hanya boleh huruf kecil, angka, dan tanda hubung"),
  projectUrl: z.string().url("URL tidak valid").optional().or(z.literal("")),
  startedAt: z.string().optional().or(z.literal("")),
  completedAt: z.string().optional().or(z.literal("")),
  durationMonths: z.coerce.number().int().min(0).optional().or(z.literal("")),
  teamSize: z.coerce.number().int().min(0).optional().or(z.literal("")),
  isFeatured: z.coerce.boolean().default(false),
  isPublished: z.coerce.boolean().default(false),
  sortOrder: z.coerce.number().int().min(0).default(0),
  // Translation fields (id locale)
  title: z.string().min(1, "Judul proyek wajib diisi").max(200, "Maksimal 200 karakter"),
  summary: z.string().optional().or(z.literal("")),
  challenge: z.string().optional().or(z.literal("")),
  solution: z.string().optional().or(z.literal("")),
  result: z.string().optional().or(z.literal("")),
  content: z.string().optional().or(z.literal("")),
});

export type ProjectInput = z.infer<typeof projectSchema>;

// ── Post (Blog) ──
export const postSchema = z.object({
  slug: z
    .string()
    .min(1, "Slug wajib diisi")
    .max(200, "Maksimal 200 karakter")
    .regex(/^[a-z0-9]+(?:-[a-z0-9]+)*$/, "Slug hanya boleh huruf kecil, angka, dan tanda hubung"),
  categoryId: z.string().uuid("Kategori tidak valid").optional().or(z.literal("")),
  status: z.enum(["draft", "published"]).default("draft"),
  isFeatured: z.coerce.boolean().default(false),
  // Translation fields (id locale)
  title: z.string().min(1, "Judul artikel wajib diisi").max(255, "Maksimal 255 karakter"),
  excerpt: z.string().optional().or(z.literal("")),
  content: z.string().min(1, "Konten artikel wajib diisi"),
});

export type PostInput = z.infer<typeof postSchema>;

// ── Post Category ──
export const postCategorySchema = z.object({
  slug: z
    .string()
    .min(1, "Slug wajib diisi")
    .max(100, "Maksimal 100 karakter")
    .regex(/^[a-z0-9]+(?:-[a-z0-9]+)*$/, "Slug hanya boleh huruf kecil, angka, dan tanda hubung"),
  sortOrder: z.coerce.number().int().min(0).default(0),
  // Translation
  name: z.string().min(1, "Nama kategori wajib diisi").max(100, "Maksimal 100 karakter"),
});

export type PostCategoryInput = z.infer<typeof postCategorySchema>;

// ── Job Opening (Karir) ──
export const jobOpeningSchema = z.object({
  slug: z
    .string()
    .min(1, "Slug wajib diisi")
    .max(150, "Maksimal 150 karakter")
    .regex(/^[a-z0-9]+(?:-[a-z0-9]+)*$/, "Slug hanya boleh huruf kecil, angka, dan tanda hubung"),
  department: z.string().max(100, "Maksimal 100 karakter").optional().or(z.literal("")),
  employmentType: z.enum(["full_time", "part_time", "contract", "internship"]).default("full_time"),
  workMode: z.enum(["onsite", "remote", "hybrid"]).default("onsite"),
  location: z.string().max(150, "Maksimal 150 karakter").optional().or(z.literal("")),
  salaryMin: z.coerce.number().min(0).optional().or(z.literal("")),
  salaryMax: z.coerce.number().min(0).optional().or(z.literal("")),
  showSalary: z.coerce.boolean().default(false),
  status: z.enum(["draft", "open", "closed"]).default("draft"),
  closesAt: z.string().optional().or(z.literal("")),
  // Translation (id locale)
  title: z.string().min(1, "Judul posisi wajib diisi").max(200, "Maksimal 200 karakter"),
  description: z.string().optional().or(z.literal("")),
  responsibilities: z.string().optional().or(z.literal("")),
  requirements: z.string().optional().or(z.literal("")),
  benefits: z.string().optional().or(z.literal("")),
});

export type JobOpeningInput = z.infer<typeof jobOpeningSchema>;
