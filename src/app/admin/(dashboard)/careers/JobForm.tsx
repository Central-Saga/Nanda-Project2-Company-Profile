"use client";

import { useActionState, useEffect } from "react";
import { createJobAction, updateJobAction } from "@/app/actions/job";
import { FormField } from "@/components/admin/FormField";
import { SubmitButton } from "@/components/admin/SubmitButton";
import { useRouter } from "next/navigation";
import Link from "next/link";

interface JobFormProps {
  initialData?: {
    id: string;
    slug: string;
    department?: string | null;
    employmentType: string;
    workMode: string;
    location?: string | null;
    salaryMin?: number | null;
    salaryMax?: number | null;
    showSalary: boolean;
    status: string;
    closesAt?: string | null;
    title: string;
    description?: string | null;
    responsibilities?: string | null;
    requirements?: string | null;
    benefits?: string | null;
  };
}

export function JobForm({ initialData }: JobFormProps) {
  const isEditing = Boolean(initialData);
  const action = isEditing ? updateJobAction : createJobAction;
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
          Informasi Posisi
        </h2>

        <FormField
          label="Judul Posisi"
          name="title"
          required
          placeholder="Senior Backend Engineer"
          defaultValue={initialData?.title}
          errors={state?.errors?.title}
        />

        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <FormField
            label="Slug (URL)"
            name="slug"
            required
            placeholder="senior-backend-engineer"
            defaultValue={initialData?.slug}
            errors={state?.errors?.slug}
          />

          <FormField
            label="Departemen"
            name="department"
            placeholder="Engineering"
            defaultValue={initialData?.department || ""}
            errors={state?.errors?.department}
          />
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1">
              Tipe Pekerjaan
            </label>
            <select
              name="employmentType"
              defaultValue={initialData?.employmentType || "full_time"}
              className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600"
            >
              <option value="full_time">Full Time</option>
              <option value="part_time">Part Time</option>
              <option value="contract">Kontrak</option>
              <option value="internship">Magang (Internship)</option>
            </select>
          </div>

          <div>
            <label className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1">
              Mode Kerja
            </label>
            <select
              name="workMode"
              defaultValue={initialData?.workMode || "onsite"}
              className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600"
            >
              <option value="onsite">On-site</option>
              <option value="remote">Remote</option>
              <option value="hybrid">Hybrid</option>
            </select>
          </div>

          <div>
            <label className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1">
              Status Lowongan
            </label>
            <select
              name="status"
              defaultValue={initialData?.status || "draft"}
              className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600"
            >
              <option value="draft">Draft</option>
              <option value="open">Open (Buka)</option>
              <option value="closed">Closed (Tutup)</option>
            </select>
          </div>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <FormField
            label="Lokasi Penempatan"
            name="location"
            placeholder="Jakarta / Bandung / Yogyakarta"
            defaultValue={initialData?.location || ""}
            errors={state?.errors?.location}
          />

          <FormField
            label="Batas Pendaftaran (Closes At)"
            name="closesAt"
            type="date"
            defaultValue={initialData?.closesAt || ""}
            errors={state?.errors?.closesAt}
          />
        </div>
      </div>

      <div className="p-5 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-sm font-bold font-mono uppercase tracking-wider text-zinc-300">
          Uraian Pekerjaan
        </h2>

        <FormField
          label="Deskripsi Umum"
          name="description"
          multiline
          rows={3}
          defaultValue={initialData?.description || ""}
          errors={state?.errors?.description}
        />

        <FormField
          label="Tanggung Jawab (Responsibilities)"
          name="responsibilities"
          multiline
          rows={4}
          defaultValue={initialData?.responsibilities || ""}
          errors={state?.errors?.responsibilities}
        />

        <FormField
          label="Kualifikasi / Persyaratan (Requirements)"
          name="requirements"
          multiline
          rows={4}
          defaultValue={initialData?.requirements || ""}
          errors={state?.errors?.requirements}
        />

        <FormField
          label="Benefit & Fasilitas"
          name="benefits"
          multiline
          rows={3}
          defaultValue={initialData?.benefits || ""}
          errors={state?.errors?.benefits}
        />
      </div>

      <div className="flex items-center gap-3">
        <SubmitButton
          pending={isPending}
          label={isEditing ? "Perbarui Lowongan" : "Buka Lowongan"}
        />
        <Link
          href="/admin/careers"
          className="px-4 py-2 text-sm text-zinc-400 hover:text-zinc-200 transition"
        >
          Batal
        </Link>
      </div>
    </form>
  );
}
