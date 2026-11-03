"use client";

import { useActionState, useEffect } from "react";
import { createProjectAction, updateProjectAction } from "@/app/actions/project";
import { FormField } from "@/components/admin/FormField";
import { SubmitButton } from "@/components/admin/SubmitButton";
import { useRouter } from "next/navigation";
import Link from "next/link";

interface ProjectFormProps {
  initialData?: {
    id: string;
    slug: string;
    projectUrl?: string | null;
    startedAt?: string | null;
    completedAt?: string | null;
    durationMonths?: number | null;
    teamSize?: number | null;
    isFeatured: boolean;
    isPublished: boolean;
    sortOrder: number;
    title: string;
    summary?: string | null;
    challenge?: string | null;
    solution?: string | null;
    result?: string | null;
    content?: string | null;
  };
}

export function ProjectForm({ initialData }: ProjectFormProps) {
  const isEditing = Boolean(initialData);
  const action = isEditing ? updateProjectAction : createProjectAction;
  const [state, formAction, isPending] = useActionState(action, null);
  const router = useRouter();

  useEffect(() => {
    if (state?.success && state?.redirectUrl) {
      router.push(state.redirectUrl);
    }
  }, [state, router]);

  return (
    <form action={formAction} className="space-y-6 max-w-3xl">
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
          label="Judul Proyek"
          name="title"
          required
          defaultValue={initialData?.title}
          errors={state?.errors?.title}
        />

        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <FormField
            label="Slug (URL)"
            name="slug"
            required
            placeholder="sistem-erp-manufaktur"
            defaultValue={initialData?.slug}
            errors={state?.errors?.slug}
          />

          <FormField
            label="URL Proyek (Opsional)"
            name="projectUrl"
            type="url"
            placeholder="https://..."
            defaultValue={initialData?.projectUrl || ""}
            errors={state?.errors?.projectUrl}
          />
        </div>

        <FormField
          label="Ringkasan Singkat"
          name="summary"
          multiline
          rows={2}
          defaultValue={initialData?.summary || ""}
          errors={state?.errors?.summary}
        />
      </div>

      <div className="p-5 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-sm font-bold font-mono uppercase tracking-wider text-zinc-300">
          Studi Kasus (Case Study)
        </h2>

        <FormField
          label="Tantangan (Challenge)"
          name="challenge"
          multiline
          rows={3}
          defaultValue={initialData?.challenge || ""}
          errors={state?.errors?.challenge}
        />

        <FormField
          label="Solusi (Solution)"
          name="solution"
          multiline
          rows={3}
          defaultValue={initialData?.solution || ""}
          errors={state?.errors?.solution}
        />

        <FormField
          label="Dampak & Hasil (Result)"
          name="result"
          multiline
          rows={3}
          defaultValue={initialData?.result || ""}
          errors={state?.errors?.result}
        />

        <FormField
          label="Konten Lengkap (Markdown / Text)"
          name="content"
          multiline
          rows={6}
          defaultValue={initialData?.content || ""}
          errors={state?.errors?.content}
        />
      </div>

      <div className="p-5 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-sm font-bold font-mono uppercase tracking-wider text-zinc-300">
          Metadata & Tampilan
        </h2>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <FormField
            label="Tanggal Mulai"
            name="startedAt"
            type="date"
            defaultValue={initialData?.startedAt || ""}
            errors={state?.errors?.startedAt}
          />

          <FormField
            label="Tanggal Selesai"
            name="completedAt"
            type="date"
            defaultValue={initialData?.completedAt || ""}
            errors={state?.errors?.completedAt}
          />
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          <FormField
            label="Durasi (Bulan)"
            name="durationMonths"
            type="number"
            defaultValue={initialData?.durationMonths ? String(initialData.durationMonths) : ""}
            errors={state?.errors?.durationMonths}
          />

          <FormField
            label="Ukuran Tim"
            name="teamSize"
            type="number"
            defaultValue={initialData?.teamSize ? String(initialData.teamSize) : ""}
            errors={state?.errors?.teamSize}
          />

          <FormField
            label="Urutan Tampil"
            name="sortOrder"
            type="number"
            defaultValue={initialData ? String(initialData.sortOrder) : "0"}
            errors={state?.errors?.sortOrder}
          />
        </div>

        <div className="flex items-center gap-6 pt-2">
          <label className="flex items-center gap-2 cursor-pointer">
            <input
              type="checkbox"
              name="isFeatured"
              defaultChecked={initialData ? initialData.isFeatured : false}
              className="w-4 h-4 rounded bg-zinc-900 border-zinc-700 text-red-600 focus:ring-red-600"
            />
            <span className="text-xs font-mono uppercase text-zinc-300">
              Jadikan Unggulan (Featured)
            </span>
          </label>

          <label className="flex items-center gap-2 cursor-pointer">
            <input
              type="checkbox"
              name="isPublished"
              defaultChecked={initialData ? initialData.isPublished : false}
              className="w-4 h-4 rounded bg-zinc-900 border-zinc-700 text-red-600 focus:ring-red-600"
            />
            <span className="text-xs font-mono uppercase text-zinc-300">
              Publikasikan
            </span>
          </label>
        </div>
      </div>

      <div className="flex items-center gap-3">
        <SubmitButton
          pending={isPending}
          label={isEditing ? "Perbarui Proyek" : "Simpan Proyek"}
        />
        <Link
          href="/admin/portfolio"
          className="px-4 py-2 text-sm text-zinc-400 hover:text-zinc-200 transition"
        >
          Batal
        </Link>
      </div>
    </form>
  );
}
