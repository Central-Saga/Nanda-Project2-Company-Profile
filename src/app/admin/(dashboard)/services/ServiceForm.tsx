"use client";

import { useActionState, useEffect } from "react";
import { createServiceAction, updateServiceAction } from "@/app/actions/service";
import { FormField } from "@/components/admin/FormField";
import { SubmitButton } from "@/components/admin/SubmitButton";
import { useRouter } from "next/navigation";
import Link from "next/link";

interface ServiceFormProps {
  initialData?: {
    id: string;
    slug: string;
    icon?: string | null;
    sortOrder: number;
    isPublished: boolean;
    name: string;
    tagline?: string | null;
    summary?: string | null;
    description?: string | null;
  };
}

export function ServiceForm({ initialData }: ServiceFormProps) {
  const isEditing = Boolean(initialData);
  const action = isEditing ? updateServiceAction : createServiceAction;
  const [state, formAction, isPending] = useActionState(action, null);
  const router = useRouter();

  useEffect(() => {
    if (state?.success && state?.redirectUrl) {
      router.push(state.redirectUrl);
    }
  }, [state, router]);

  return (
    <form action={formAction} className="space-y-6 max-w-2xl">
      {isEditing && <input type="hidden" name="id" value={initialData!.id} />}

      {state?.message && !state?.success && (
        <div className="p-3 bg-red-950/50 border border-red-700/50 text-red-300 text-sm rounded font-mono">
          {state.message}
        </div>
      )}

      <div className="p-5 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-sm font-bold font-mono uppercase tracking-wider text-zinc-300">
          Informasi Utama
        </h2>

        <FormField
          label="Nama Layanan"
          name="name"
          required
          defaultValue={initialData?.name}
          errors={state?.errors?.name}
        />

        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <FormField
            label="Slug (URL)"
            name="slug"
            required
            placeholder="custom-software-development"
            defaultValue={initialData?.slug}
            errors={state?.errors?.slug}
          />

          <FormField
            label="Icon (Identifier / Lucide Name)"
            name="icon"
            placeholder="code-2"
            defaultValue={initialData?.icon || ""}
            errors={state?.errors?.icon}
          />
        </div>

        <FormField
          label="Tagline Singkat"
          name="tagline"
          defaultValue={initialData?.tagline || ""}
          errors={state?.errors?.tagline}
        />

        <FormField
          label="Ringkasan (Summary)"
          name="summary"
          multiline
          rows={3}
          defaultValue={initialData?.summary || ""}
          errors={state?.errors?.summary}
        />

        <FormField
          label="Deskripsi Lengkap"
          name="description"
          multiline
          rows={5}
          defaultValue={initialData?.description || ""}
          errors={state?.errors?.description}
        />
      </div>

      <div className="p-5 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-sm font-bold font-mono uppercase tracking-wider text-zinc-300">
          Pengaturan Tampilan
        </h2>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <FormField
            label="Urutan Tampil (Sort Order)"
            name="sortOrder"
            type="number"
            defaultValue={initialData ? String(initialData.sortOrder) : "0"}
            errors={state?.errors?.sortOrder}
          />

          <div className="flex items-center pt-6">
            <label className="flex items-center gap-2 cursor-pointer">
              <input
                type="checkbox"
                name="isPublished"
                defaultChecked={initialData ? initialData.isPublished : false}
                className="w-4 h-4 rounded bg-zinc-900 border-zinc-700 text-red-600 focus:ring-red-600"
              />
              <span className="text-xs font-mono uppercase text-zinc-300">
                Publikasikan ke Website
              </span>
            </label>
          </div>
        </div>
      </div>

      <div className="flex items-center gap-3">
        <SubmitButton
          pending={isPending}
          label={isEditing ? "Perbarui Layanan" : "Tambah Layanan"}
        />
        <Link
          href="/admin/services"
          className="px-4 py-2 text-sm text-zinc-400 hover:text-zinc-200 transition"
        >
          Batal
        </Link>
      </div>
    </form>
  );
}
