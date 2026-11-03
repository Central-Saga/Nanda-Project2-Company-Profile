"use client";

import { useActionState } from "react";
import { updateCompanyProfileAction } from "@/app/actions/company";
import { FormField } from "@/components/admin/FormField";
import { SubmitButton } from "@/components/admin/SubmitButton";

interface CompanyProfileFormProps {
  initialData: {
    companyName: string;
    tagline?: string | null;
    aboutShort?: string | null;
    address?: string | null;
    phone?: string | null;
    emailPublic?: string | null;
    operatingHours?: string | null;
    socialLinks?: string | null;
  };
}

export function CompanyProfileForm({ initialData }: CompanyProfileFormProps) {
  const [state, formAction, isPending] = useActionState(updateCompanyProfileAction, null);

  return (
    <form action={formAction} className="space-y-6 max-w-2xl">
      {state?.message && (
        <div
          className={`p-3 rounded text-sm font-mono border ${
            state.success
              ? "bg-green-950/50 border-green-700/50 text-green-300"
              : "bg-red-950/50 border-red-700/50 text-red-300"
          }`}
        >
          {state.message}
        </div>
      )}

      <div className="p-5 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-sm font-bold font-mono uppercase tracking-wider text-zinc-300">
          Informasi Utama
        </h2>

        <FormField
          label="Nama Perusahaan"
          name="companyName"
          required
          defaultValue={initialData.companyName}
          errors={state?.errors?.companyName}
        />

        <FormField
          label="Tagline"
          name="tagline"
          defaultValue={initialData.tagline || ""}
          errors={state?.errors?.tagline}
        />

        <FormField
          label="Tentang Singkat"
          name="aboutShort"
          multiline
          rows={3}
          defaultValue={initialData.aboutShort || ""}
          errors={state?.errors?.aboutShort}
        />
      </div>

      <div className="p-5 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-sm font-bold font-mono uppercase tracking-wider text-zinc-300">
          Kontak & Operasional
        </h2>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <FormField
            label="Email Publik"
            name="emailPublic"
            type="email"
            defaultValue={initialData.emailPublic || ""}
            errors={state?.errors?.emailPublic}
          />

          <FormField
            label="Nomor Telepon"
            name="phone"
            defaultValue={initialData.phone || ""}
            errors={state?.errors?.phone}
          />
        </div>

        <FormField
          label="Alamat Lengkap"
          name="address"
          multiline
          rows={2}
          defaultValue={initialData.address || ""}
          errors={state?.errors?.address}
        />

        <FormField
          label="Jam Operasional (JSON)"
          name="operatingHours"
          multiline
          rows={3}
          hint='Contoh: {"senin-jumat": "09:00 - 18:00"}'
          defaultValue={initialData.operatingHours || ""}
          errors={state?.errors?.operatingHours}
        />

        <FormField
          label="Media Sosial (JSON)"
          name="socialLinks"
          multiline
          rows={3}
          hint='Contoh: {"github": "https://github.com/...", "linkedin": "https://..."}'
          defaultValue={initialData.socialLinks || ""}
          errors={state?.errors?.socialLinks}
        />
      </div>

      <div>
        <SubmitButton pending={isPending} label="Simpan Perubahan" />
      </div>
    </form>
  );
}
